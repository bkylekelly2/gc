//////////////////////////////////////////////////////////////////////////////////
/* tooltip */



/* end tooltip */

//set variables

// Get the metadata modal
var metaModal = document.getElementById('metaModal');

// Get the button that opens the modal
var metaBtn = document.getElementById("metaBtn");

// Get the <span> element that closes the modal
var metaSpan = document.getElementById("close0");

// When the user clicks the button, open the modal
metaBtn.onclick = function() {
    metaModal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
metaSpan.onclick = function() {
    metaModal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === metaModal) {
        metaModal.style.display = "none";
    }
};

/////////////////////////////////////////////////////////////////////////////////
// Get the enlargeImage modal
var enlargeImageModal = document.getElementById('enlargeImageModal');

// Get the button that opens the modal
var enlargeImageBtn = document.getElementById("enlargeImageBtn");

// Get the <span> element that closes the modal
var enlargeImageSpan = document.getElementById("close1");


// When the user clicks the button, open the modal
enlargeImageBtn.onclick = function() {
    enlargeImageModal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
enlargeImageSpan.onclick = function() {
    enlargeImageModal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === enlargeImageModal) {
        enlargeImageModal.style.display = "none";
    }
};

/////////////////////////////////////////////////////////////////////////////
function openInteractiveGraph(nodeID){
    var url = '/browse/indicator-interactive_graph/'+nodeID;
    var myHeight = 800;
    var myWidth = 800;
    var left = (screen.width - myWidth) / 2;
    var top = (screen.height - myHeight) / 4;
    var title = '';
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
}
//////////////////////////////////////////////////////////////////////////////
function forceDownload(link){
    var url = link.getAttribute("data-href");
    var fileName = link.getAttribute("download");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function(){
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = fileName;
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
        link.innerText="Download Image";
    }
    xhr.send();
}