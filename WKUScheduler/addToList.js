document.getElementById("add").onclick = addToList()
{
    var text = document.getElementById("courseNum").value;
    var li = "<li>" + text + "</li>";
    document.getElementById("list").appendChild(li);
}
      