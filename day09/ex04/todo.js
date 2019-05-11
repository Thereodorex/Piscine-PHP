$(document).ready(function()
{
    getcook();
});

function cook(todo)
{
    req("insert.php?" + todo + "=" + todo);
}

function print(todo)
{
    $("#ft_list").prepend($('<div>' + todo + '</div>').click(function(){
        if (confirm("Remove " + todo))
            req("delete.php?" + todo + "=" + todo);
        $(this).remove();
    }));
}

function getcook()
{
    $.ajax({
        url: "select.php",
        success: function(response){
            var cks = response.split(";");
            console.log(response);
            for (let i in cks)
                print(cks[i].split("=").shift());
        },
        error: function(status) {
            console.log(status);
        }
    });
}

function req(ur)
{
    var res;
    $.ajax({
        url: ur,
    });
}