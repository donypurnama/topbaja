<?php
if (!function_exists("http_404")) {
    function http_404() {
        $instance =& get_instance();
        $instance->utility->page([
            "link" => "<link rel=\"stylesheet\" href=\"static/css/page_404.css\">",
            "title" => "Page not found! | EisenTrick",
            "main" => $instance->parser->parse("main/page_404", [
                "back_url" => isset($_SERVER["HTTP_REFERER"]) ? htmlspecialchars($_SERVER["HTTP_REFERER"]) : base_url(),
                "base_url" => base_url()
            ], true)
        ]);
    }
}
?>
