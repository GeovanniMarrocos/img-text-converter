
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <!-- Coluna da imagem -->
        <div class="col-md-6">
            <label>Imagem</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        
        <!-- Coluna da quantidade de caracteres -->
        <div class="col-md-6">
            <label>Quantidade de caracteres por linha</label>
            <input type="number" class="form-control" name="width" value="100" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">Converter a imagem</button>
        </div>
    </div>
</form>