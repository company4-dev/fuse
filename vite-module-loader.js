import fs from 'fs/promises';
import path from 'path';
import { pathToFileURL } from 'url';

async function collectModuleAssetsPaths(paths, PlatformsPath) {
    const __dirname = path.resolve(path.dirname(''));
    const PlatformStatusesPath = path.join(__dirname, 'platform_statuses.json');

    PlatformsPath = path.join(__dirname, PlatformsPath);

    try {
        // Read module_statuses.json
        const PlatformStatusesContent = await fs.readFile(PlatformStatusesPath, 'utf-8');
        const PlatformStatuses = JSON.parse(PlatformStatusesContent);

        // Read module directories
        const moduleDirectories = await fs.readdir(PlatformsPath);

        for (const moduleDir of moduleDirectories) {
            if (moduleDir === '.DS_Store') {
                // Skip .DS_Store directory
                continue;
            }

            // Check if the module is enabled (status is true)
            if (PlatformStatuses[moduleDir] === true) {
                const viteConfigPath = path.join(PlatformsPath, moduleDir, 'vite.config.js');

                try {
                    await fs.access(viteConfigPath);
                    // Convert to a file URL for Windows compatibility
                    const moduleConfigURL = pathToFileURL(viteConfigPath);

                    // Import the module-specific Vite configuration
                    const moduleConfig = await import(moduleConfigURL.href);

                    if (moduleConfig.paths && Array.isArray(moduleConfig.paths)) {
                        paths.push(...moduleConfig.paths);
                    }
                } catch (error) {
                    console.log(`Error reading module configuration: ${error}`);

                    // vite.config.js does not exist, skip this module
                }
            }
        }
    } catch (error) {
        console.error(`Error reading module statuses or module configurations: ${error}`);
    }

    return paths;
}

export default collectModuleAssetsPaths;
