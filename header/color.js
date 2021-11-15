function getCookie(cname, fallback) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return fallback;
}

root = document.documentElement;
const dark = getCookie("dark", "false");
user_mode  = getCookie("mode", "U");

if(dark == "true") {
    $('#color').html('<svg style="fill: var(--grey-fa) !important;" xmlns="http://www.w3.org/2000/svg" width="22" height="21.9" viewBox="0 0 22 21.9"><path id="Icon_material-wb-sunny" data-name="Icon material-wb-sunny" d="M6.76,4.84,4.96,3.05,3.55,4.46,5.34,6.25ZM4,10.5H1v2H4ZM13,.55H11V3.5h2V.55Zm7.45,3.91L19.04,3.05,17.25,4.84l1.41,1.41Zm-3.21,13.7,1.79,1.8,1.41-1.41-1.8-1.79-1.4,1.4ZM20,10.5v2h3v-2Zm-8-5a6,6,0,1,0,6,6A6,6,0,0,0,12,5.5ZM11,22.45h2V19.5H11ZM3.55,18.54l1.41,1.41,1.79-1.8L5.34,16.74Z" transform="translate(-1 -0.55)"/></svg>');
    $('#color').css('background-color','var(--orange)');

    root.style.setProperty('--text', 'var(--grey-aa)');
    root.style.setProperty('--text-light', 'var(--grey-b5)');

    root.style.setProperty('--bg', 'var(--grey-22)');
    root.style.setProperty('--pure', 'var(--grey-16)');
} else {
    $('#color').html('<svg style="fill: var(--grey-fa) !important;" xmlns="http://www.w3.org/2000/svg" width="16.914" height="18.925" viewBox="0 0 16.914 18.925"><path id="Icon_awesome-moon" data-name="Icon awesome-moon" d="M10.738,18.925a9.445,9.445,0,0,0,7.35-3.5.444.444,0,0,0-.427-.715A7.413,7.413,0,0,1,12.606.98a.444.444,0,0,0-.139-.822,9.463,9.463,0,1,0-1.729,18.767Z" transform="translate(-1.276 0)"/></svg>');
    $('#color').css('background-color','var(--purple)');

    root.style.setProperty('--text', 'var(--grey-70)');
    root.style.setProperty('--text-light', 'var(--grey-b5)');

    root.style.setProperty('--bg', 'var(--grey-fa)');
    root.style.setProperty('--pure', 'var(--grey-ff)');
}