$(document).ready(function(){
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    
    $('.dropdown-toggle').dropdown()
})

function remove_space(name) {
    var string = name;
    var res = string.trim();

    return res
}