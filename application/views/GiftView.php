<div class="col-lg-6">
    <?php
        echo "<img src='" . $data['gift']['photo'] . "' class='img-responsive'>";

    ?>
</div>
<div class="col-lg-6">
    <div class="col-lg-12">
        <?php
            echo $data['gift']["name"];
        ?>
    </div>
    <div class="col-lg-12">
        <?php
            echo $data['gift']["description"];
        ?>
    </div>
    <?php
        if (isset($data['user'])) {
            echo '<a href="/gift/bind/' . $data["id"] . '" class="btn btn-success">Подарить</a>';
        }
    ?>
</div>