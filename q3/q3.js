function myApp() {
    var apiUrl = "http://api.flickr.com/services/feeds/photos_public.gne?tags=puppies&format=json";
    var gallery = {
        items: [],
        slideIndex: 0,
        slides: []
    };
    var photoArea = document.getElementById("photo-area");
    var refreshBtn = document.getElementById("refresh-btn");
    var lightboxModal = document.getElementById("lightbox-modal");
    var statusMsg = document.getElementById("status-msg");
    var prev = document.getElementById("prev");
    var next = document.getElementById("next");
    var close = document.getElementById("close");
    var tagsInput = document.getElementById("tags");
    var modalContent = document.getElementById("modal-content");

    refreshBtn.addEventListener("click", function (evt) {
        evt.stopPropagation();
        refreshFeed();
    });
    refreshFeed();

    prev.addEventListener("click", function(evt) {
        evt.stopPropagation();
        gallery.slideIndex--;
        if (gallery.slideIndex < 0) {
            gallery.slideIndex = gallery.items.length - 1;
        }
        lightbox();
    });
    next.addEventListener("click", function(evt) {
        evt.stopPropagation();
        gallery.slideIndex++;
        if (gallery.slideIndex > (gallery.items.length - 1)) {
            gallery.slideIndex = 0;
        }
        lightbox();
    });
    close.addEventListener("click", function(evt) {
        evt.stopPropagation();
        lightboxModal.style.display = "none";
    });
    document.addEventListener("keydown", function(evt) {
        if (evt.keyCode == 27) {
            lightboxModal.style.display = "none";
        }
    });
    tagsInput.addEventListener("keydown", function(evt) {
        // console.log(this.value)
        apiUrl = "http://api.flickr.com/services/feeds/photos_public.gne?tags=" + encodeURI(this.value) + "&format=json";
        if (evt.keyCode == 13) {
            refreshFeed();
        }
    });
    tagsInput.focus();

    /**
     * Wrapper for document.createElement
     *
     * @param tag HTML tagname
     * @param parent Where to append the new Node
     * @param props Element properties to set
     * @param events array of objects with schema: [{type:"string", handler:function(event){}}] Element events to add to new Node
     * @returns {Element} The new Node
     */
    function newEl(tag, parent, props, events) {
        var el = document.createElement(tag);
        if (props) {
            for (var prop in props) {
                el[prop] = props[prop];
            }
        }
        if (events) {
            for (var event in events) {
                el.addEventListener(event, events[event]);
            }
        }

        parent.appendChild(el);
        return el;
    }

    /**
     * This function is called by Flickr API jsonp (so don't change the function name)
     * @param json
     */
    function jsonFlickrFeed(json) {
        console.log("jsonFlickrFeed");
        gallery.items = json.items;

        gallery.items.forEach(function (item, index) {
            var photoDiv = newEl("div", photoArea, {
                // id: "photo_" + index,
                className: "photo"
            });

            var imgElement = newEl("img", photoDiv, {
                id: "thumbnail_" + index,
                src: item.media.m
            }, {
                click: function (evt) {
                    evt.stopPropagation();
                    gallery.slideIndex = this.id.substring(this.id.indexOf("_") + 1);
                    lightbox.call(this);
                },
                mouseover: function() {
                    // gallery.slideIndex = this.id.substring(this.id.indexOf("_") + 1);
                    //console.log(gallery.slideIndex)
                }
            });

            var slide = newEl("div", modalContent, {
                className: "slide"
            });
            gallery.slides.push(slide);
            var numbertext = newEl("div", slide, {
                className: "numbertext",
                innerText: (index + 1) + " / " + gallery.items.length
            });
            var a = newEl("a", slide, {
                href: item.link,
                target: "_blank"
            });
            var img = newEl("img", a, {
                src: item.media.m,
                className: "slide-img"
            });
            var captionContainer = newEl("div", slide, {
                className: "caption-container",
                innerHTML: item.title
            });
        });

        statusMsg.innerText = "Loaded.";
        console.log(gallery);
    }

    function lightbox() {
        lightboxModal.style.display = "block";

        gallery.slides.forEach(function(slide) {
            slide.style.display = "none";
        });

        gallery.slides[gallery.slideIndex].style.display = "block";
    }


    /**
     * Ajax call to Flickr API
     */
    function refreshFeed() {
        // var url = //"photos_public.json";
        //     "http://api.flickr.com/services/feeds/photos_public.gne?tags=puppies&format=json";

        statusMsg.innerText = "Loading...";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', apiUrl, true);
        xhr.responseType = 'text';
        xhr.onload = function () {
            var status = xhr.status;
            console.log(xhr);
            if (status == 200) {
                //callback(xhr.response);
                eval(xhr.responseText);
            } else {
                statusMsg.innerText = "Error loading Flickr feed. Status: " + status;
            }
        };
        xhr.send();

        // Load and draw photos
        gallery = {
            items: [],
            slideIndex: 0,
            slides: []
        };

        photoArea.innerHTML = "";
        modalContent.innerHTML = "";
        gallery.slides = [];
    }

}

document.addEventListener("DOMContentLoaded", function (event) {
    console.log("DOM fully loaded and parsed");
    myApp();
});
