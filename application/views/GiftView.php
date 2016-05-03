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
        if (!isset($data['owner'])) {
            if (isset($data["sender"])) {
                echo "Вы собираетесь это подарить";
            } else if (isset($data["flagged"])) {
                    echo "Этот подарок уже собираются подарить";
                } else {
                    echo '<a href="/gift/bind/' . $data["gift"]["id"] . '" class="btn btn-success">Подарить</a>';
                }
        } else {
            echo '<a href="/gift/delete/' . $data["gift"]["id"] . '" class="btn btn-danger">Удалить</a>';
        }
    ?>
</div>