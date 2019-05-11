window.onload = function()
{
    getcook();
}

function print(todo)
{
    var div = document.createElement('div');
    var text = document.createTextNode(todo);
    div.appendChild(text);
    div.addEventListener('click', function(){uncook(todo)});
    document.getElementById("ft_list").insertBefore(div, document.getElementById("ft_list").firstChild);
}

function getcook()
{
    var cks = document.cookie.split(";");
    for (i in cks)
        print(cks[i].split("=").shift());

}

function cook(todo)
{
    document.cookie = todo + "=" + todo + ";";
}

function uncook(todo)
{
    if (confirm("Remove " + todo))
        document.cookie = todo + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    location.reload(true);
}