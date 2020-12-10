//When user clicks on send message button
$("#sendMessage").click(function () {
    var userMessage = $("#userMessage").val();
    $.post("../post.php", { text: userMessage });
    $("#userMessage").attr("value", "");
});


$('#chatbox').scrollTop($('#chatbox')[0].scrollHeight); //Scroll to bottom of chatbox on page load

//Load the file containing the chat log
function loadLog() {
    console.log("ajax function called")
    var oldscrollHeight = $("#chatbox").prop("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "chat.html",
        cache: false,
        success: function (html) {
            $("#chatbox").html(html); //Insert chat log into the #chatbox div
            //Auto-scroll			
            var newscrollHeight = $("#chatbox").prop("scrollHeight") - 20; //Scroll height after the request
            if (newscrollHeight > oldscrollHeight) {
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }
        },
    });
}
setInterval(loadLog, 1500);	//Reload file every x ms
