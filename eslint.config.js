import js from "@eslint/js";
import globals from "globals";
import json from "@eslint/json";
import markdown from "@eslint/markdown";
import { defineConfig } from "eslint/config";

let ignores = [
    "node_modules/**",
    "package-lock.json",
    ".vscode/**",
    "vendor**/"
];

export default defineConfig([
    {
        ignores: ignores,
    },
    {
        files: [
            "**/*.{js,mjs,cjs}"
        ],
        plugins: {
            js
        },
        extends: [
            "js/recommended"
        ],
        languageOptions: {
            globals: {
                ...globals.browser,
            }
        }
    },
    {
        files: [
            "**/*.json"
        ],
        plugins: {
            json
        },
        language: "json/json",
        extends: [
            "json/recommended"
        ]
    },
    {
        files: [
            "**/*.md"
        ],
        plugins: {
            markdown
        },
        language: "markdown/gfm",
        extends: [
            "markdown/recommended"
        ]
    },
]);
