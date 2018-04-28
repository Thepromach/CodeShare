

function View(){


    $("#right").empty();

    const title = $("#Title").val();
    const language = $("#Language").val();
    const code = $("#Code").val();

    var a = '<div hidden class="code"><h2>' + title + '</h2>' +
            '<pre id="View"><code class="' + language + '">'+ code + '</code></pre></div>';

    $("#right").append(a);
    
    $("#right .code").fadeIn(1000);
    hljs.highlightBlock(document.getElementById("View"));
}