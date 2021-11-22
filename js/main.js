let blockHieght;
document.querySelector("#skip-block").addEventListener("clikc", () => {
    blockHieght = document.querySelector('.banner').offsetHeight;

    document.body.scrollTop = document.body.scrollTop + blockHieght;
    document.documentElement.scrollTop = document.documentElement.scrollTop + blockHieght;
});
