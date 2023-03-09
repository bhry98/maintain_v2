
function hint_(theme, title, mess) {
    var message = mess;
    var theme = theme;
    var title = title;
    var position = "right-top";
    var animation = "slide-left";
    Fnon.Hint[theme](message, {
        title,
        position,
        animation,
    })
}

function alert_(mes, style_) {

    var fun = "Alert";
    var style = style_;
    var mess = mes;
    var wid = "sm";
    var anim = "fade";

    Fnon[fun][style]({
        // title: "alertTitle.value",
        message: mess,
        width: wid,
        zIndex: 999999,
        closeButton: true,
        animation: anim
    })
}
function _submit() {
    document.getElementById("form").submit();
    document.getElementById("btn").disabled = true;
    document.getElementById("btn").innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6l0 -3"></path><path d="M16.25 7.75l2.15 -2.15"></path><path d="M18 12l3 0"></path><path d="M16.25 16.25l2.15 2.15"></path><path d="M12 18l0 3"></path><path d="M7.75 16.25l-2.15 2.15"></path><path d="M6 12l-3 0"></path><path d="M7.75 7.75l-2.15 -2.15"></path></svg>';
}

function _vali(e) {
    if (e != null) {
        if (e.length < 6) {
            document.getElementById("btn").disabled = true;
        } else {
            document.getElementById("btn").disabled = false;
        }
    }

}