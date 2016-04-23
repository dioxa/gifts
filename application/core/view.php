<?php
class View {
    function generate($content_view, $data = null) {
        if (empty($_SESSION["username"])) {
            $template_view = "GuestTemplateView.php";
        } else {
            $template_view = "TemplateView.php";
        }
        if(is_array($data)) {
            extract($data);
        }
        include 'application/views/'.$template_view;
    }
}
?>