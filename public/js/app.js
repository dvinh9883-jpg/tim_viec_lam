'use strict';

// Tự ẩn thông báo flash sau một khoảng thời gian, nhưng vẫn để người dùng đọc được.
document.addEventListener('DOMContentLoaded', () => {
    const flash = document.querySelector('.flash');
    if (!flash) return;

    window.setTimeout(() => {
        flash.classList.add('flash--dismissed');
        window.setTimeout(() => flash.remove(), 300);
    }, 6000);
});
