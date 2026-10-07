(function () {
    const storageKey = 'tabungan-theme';
    const root = document.documentElement;

    function setTheme(dark) {
        root.classList.toggle('dark', dark);

        try {
            localStorage.setItem(storageKey, dark ? 'dark' : 'light');
        } catch (error) {
            // Theme changes still apply for the current page if storage is unavailable.
        }

        const color = dark ? '#101812' : '#f6f8f4';
        const themeColor = document.querySelector('meta[name="theme-color"]');
        if (themeColor) themeColor.setAttribute('content', color);

        document.querySelectorAll('#theme-toggle').forEach((button) => {
            button.setAttribute('aria-pressed', dark ? 'true' : 'false');
            button.setAttribute('aria-label', dark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
            button.setAttribute('title', dark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
            button.textContent = dark ? '☀' : '☾';
        });
    }

    try {
        setTheme(localStorage.getItem(storageKey) === 'dark');
    } catch (error) {
        setTheme(false);
    }

    document.addEventListener('click', (event) => {
        if (!(event.target instanceof Element) || !event.target.closest('#theme-toggle')) return;
        setTheme(!root.classList.contains('dark'));
        document.dispatchEvent(new CustomEvent('tabungan-theme-changed'));
    });

    document.addEventListener('DOMContentLoaded', () => {
        const dark = root.classList.contains('dark');
        document.querySelectorAll('#theme-toggle').forEach((button) => {
            button.setAttribute('aria-pressed', dark ? 'true' : 'false');
            button.setAttribute('aria-label', dark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
            button.setAttribute('title', dark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap');
            button.textContent = dark ? '☀' : '☾';
        });
    });
}());
