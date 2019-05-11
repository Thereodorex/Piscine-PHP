$(document).ready(function()
{
    getcook();
});

function cook(todo)
{
    document.cookie = todo + "=" + todo + ";";
}

function print(todo)
{
    $("#ft_list").prepend($('<div>' + todo + '</div>').click(function(){
        if (confirm("Remove " + todo))
            document.cookie = todo + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        $(this).remove();
    }));
}

function getcook()
{
    var cks = document.cookie.split(";");
    for (i in cks)
        print(cks[i].split("=").shift());
}