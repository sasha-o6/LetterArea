if (querySelector("#agreeButton")) {
    document.querySelector("#agreeButton").addEventListener("click", (e) => {
        if (e.target.parentNode.parentNode.querySelector("input[name='i_agree']").checked != true) {
            e.preventDefault();
        }
    })
}

if (document.querySelector("#anotherOne")) {
    document.querySelector("#anotherOne").addEventListener("click", (e) => {
        if (e.target.parentNode.parentNode.querySelector("input[name='i_agree']").checked == true) {
            e.preventDefault();
        }
    })
}
