const chromium = require("@sparticuz/chromium");

(async () => {
    const path = await chromium.executablePath();
    console.log(`${path}`);
})();
