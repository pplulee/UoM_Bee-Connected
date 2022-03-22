let post_content = document.getElementById("post_content_p");
let main_post = document.getElementById("main_post");
let read_more_btn = document.getElementById("readmore");
let img_name_report = document.getElementById("img_name_report");
let count = 0;

function read_more() {
    if ((count % 2) === 0) {
        main_post.style.height = "100%";
        main_post.style.overflow = "auto";
        main_post.style.overflowX = "hidden";
        post_content.style.overflow = "visible";
        post_content.style.display = "unset";
        img_name_report.style.height = "100%";
        count += 1;
    } else {
        main_post.style.height = "33.3%";
        main_post.style.minHeight = "0%";
        main_post.style.overflow = "hidden";
        post_content.style.overflow = "hidden";
        post_content.style.display = "-webkit-box";
        post_content.style.WebkitLineClamp = "4";
        post_content.style.WebkitBoxOrient = "vertical";
        img_name_report.style.height = "87%";
        count += 1;
    }
}