$(document).ready(function() {
    $(".copy-btn").click(function() {
        var commandHtml = $(this).closest(".card-body").find(".command-text").html();
        
        // Extract text while preserving user edits
        var tempElement = $("<div>").html(commandHtml);
        tempElement.find(".editable").each(function() {
            var text = $(this).text(); // Get the user-edited text
            $(this).replaceWith(text); // Remove < > and insert plain text
        });

        var finalCommand = tempElement.text().trim(); // Get final cleaned text

        // Copy to clipboard
        var tempInput = $("<textarea>");
        $("body").append(tempInput);
        tempInput.val(finalCommand).select();
        document.execCommand("copy");
        tempInput.remove();

        $(this).text("Copied!").addClass("btn-copied").removeClass("copy-btn");
        setTimeout(() => {
            $(this).text("Copy").removeClass("btn-copied").addClass("copy-btn");
        }, 2000);
    });
});
