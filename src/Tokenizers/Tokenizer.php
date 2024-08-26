<?php

namespace Eloise\Architecture\Tokenizers;

class Tokenizer 
{
    function tokenizeFile(string $filePath): array
{
    // Read the content of the PHP file
    $code = file_get_contents($filePath);

    if ($code === false) {
        // Failed to read the file: $filePath
        return [];
    }

    // Tokenize the PHP code
    $tokens = token_get_all($code);

    $namespace = '';
    $classNames = [];
    $isNamespace = false;
    $isClass = false;
    $isImplementing = false;
    $isExtending = false;
    $currentClassIndex = null;

    // Loop through the tokens and analyze them
    foreach ($tokens as $token) {
        if (!is_array($token)) {
            continue;
        }

        $tokenType = $token[0];
        $tokenValue = $token[1];

        // Capture the namespace
        if ($tokenType === T_NAMESPACE) {
            $isNamespace = true;
            $namespace = '';
        } elseif ($isNamespace && ($tokenType === T_STRING || $tokenType === T_NS_SEPARATOR)) {
            $namespace .= $tokenValue;
        } elseif ($isNamespace && $tokenType === T_WHITESPACE) {
            $isNamespace = false;
        }

        // Capture the class name
        if ($tokenType === T_CLASS || $tokenType === T_ABSTRACT) {
            $isClass = true;
        } elseif ($isClass && $tokenType === T_STRING) {
            $currentClassIndex = count($classNames);
            $classNames[] = [
                'name' => ($namespace ? $namespace . '\\' : '') . $tokenValue,
                'extends' => '',
                'interfaces' => [],
            ];
            $isClass = false;
        }

        // Detect when the class extends another class
        if ($tokenType === T_EXTENDS) {
            $isExtending = true;
        } elseif ($isExtending && ($tokenType === T_STRING || $tokenType === T_NS_SEPARATOR)) {
            $classNames[$currentClassIndex]['extends'] .= $tokenValue;
        } elseif ($isExtending && $tokenType === T_WHITESPACE) {
            $isExtending = false;
        }

        // Detect when the class implements interfaces
        if ($tokenType === T_IMPLEMENTS) {
            $isImplementing = true;
        } elseif ($isImplementing && ($tokenType === T_STRING || $tokenType === T_NS_SEPARATOR)) {
            $interfaceName = $tokenValue;
            $classNames[$currentClassIndex]['interfaces'][] = $interfaceName;
        } elseif ($isImplementing && ($token === ',' || $token === '{')) {
            // Stop implementing interfaces when the class body starts
            $isImplementing = $token === ','; // Continue if there's another interface, stop if class body starts
        }
    }

    return $classNames;
}
}
