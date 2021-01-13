(() => {
    document.querySelectorAll('.value').forEach(item => {
        item.addEventListener('click', event => {
            const div = event.currentTarget
            navigator.clipboard
                .writeText(div.innerText)
                .then(() => {
                    div.classList.add('copied');
                    window.setTimeout(function () {
                        div.classList.remove('copied');
                    }, 300);
                    console.info('copied !');
                }, (error) => {
                    console.error(error);
                })
            ;
        });
    });
})();
