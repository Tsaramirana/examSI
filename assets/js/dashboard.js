function generateAnalogousColors(baseHue, count, saturation = 70, lightness = 50) {
    const colors = [];
    const hueStep = 10; // Smaller step between hues for closer analogous colors

    let huesGenerated = 0;
    while (huesGenerated < count) {
        const hue = (baseHue + huesGenerated * hueStep) % 360;
        if ((hue >= 210 && hue <= 240) || (hue >= 270 && hue <= 330)) {
            colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
            huesGenerated++;
        } else {
            baseHue += hueStep; // Skip hues out of desired range
        }
    }

    return colors;
}
function colorizeStats() {
    const container = document.getElementById('statistics2');
    const items = container.getElementsByClassName('stat2-items');
    const count = items.length;
    setInterval(() => {
        const baseHue = Math.floor(Math.random() * 360);
        const colors = generateAnalogousColors(baseHue, count);
        for (let i = 0; i < count; i++) {
            items[i].style.backgroundColor = colors[i];
        }
    }, 1000);
}
// Colorize the stats when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', colorizeStats);