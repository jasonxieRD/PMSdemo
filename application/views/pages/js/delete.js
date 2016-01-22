function delete_confirm(e)
{
    if (event.srcElement.outerText == "删除")
    {
        event.returnValue = confirm("你确认要删除吗？");
    }
}