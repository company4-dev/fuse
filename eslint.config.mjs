import globals from 'globals';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import js from '@eslint/js';
import { FlatCompat } from '@eslint/eslintrc';

const __filename = fileURLToPath(import.meta.url);
const __dirname  = path.dirname(__filename);
const compat     = new FlatCompat({
    baseDirectory:     __dirname,
    recommendedConfig: js.configs.recommended,
    allConfig:         js.configs.all
});

export default [
    ...compat.extends('eslint:recommended'),
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                ...globals.commonjs,
                Livewire:        true,
            },

            ecmaVersion: 13,
            sourceType: 'module',
        },

        rules: {
            'arrow-spacing': ['error'],
            'comma-spacing': [
                'error',
                {
                    after:  true,
                    before: false,
                }
            ],
            indent: [
                'error',
                4
            ],
            'keyword-spacing': ['error'],
            'linebreak-style': [
                'error',
                'unix'
            ],
            'max-len': [
                'error',
                {
                    code:                   135,
                    ignoreComments:         true,
                    ignoreRegExpLiterals:   true,
                    ignoreStrings:          true,
                    ignoreTrailingComments: true,
                    ignoreUrls:             true,
                }
            ],
            'no-prototype-builtins': 'off',
            'no-self-assign':        'off',
            quotes: [
                'error',
                'single'
            ],
            semi: [
                'error',
                'always'
            ],
            'space-before-blocks':  ['error'],
            'space-infix-ops':      ['error']
        },
    },
];
