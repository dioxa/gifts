<div class="container">
    <form action='/gift/adding' method='post' role="form" class="col-lg-6" enctype='multipart/form-data'>
        Выберите картинку:<input type='file' name='image' id='fileToUpload'><br>
        <input type='text' class="form-control" name='gift[name]'><br>
        <textarea class="form-control" name='gift[desc]'></textarea><br>
        <input type='submit' class="form-control btn-success" value='Добавить подарок' name='submit'>
    </form>
</div>