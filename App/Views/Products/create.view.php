<form method="post" action="?c=products&a=store" enctype="multipart/form-data">
    <?php
    /** @var \App\Models\Product $data */
    if ($data->getId()) { ?>
        <input type="hidden" name="id" value="<?php echo $data->getId()?>">
    <?php } ?>
    <div class="container">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Title: *</label>
            <input required="text"  maxlength="15" class="form-control" name="title" value="<?php echo $data->getTitle()?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Subclass</label>
            <input type="text"  maxlength="40" class="form-control" name="subclass" value="<?php echo $data->getSubclass()?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Price: *</label>
            <input type="number" step="0.01" min="0" class="form-control" name="price" value="<?php echo $data->getPrice()?>">
        </div>

        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Type</label>
            <select class="form-select" name="type"  required="text">
                <option ><?php echo $data->getType()?></option>

                <?php if ($data->getType() != "cestny"){ ?>
                    <option >cestny</option>
                <?php } ?>

                <?php if ($data->getType() != "horsky"){ ?>
                    <option >horsky</option>
                <?php } ?>

                <?php if ($data->getType() != "ebike"){ ?>
                    <option >ebike</option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $data->getDescription()?>">
        </div>
        <div>
            <form method="post" >
                <input type="file" name="img">
            </form>
        </div>
        <input type="submit" value="odoslať" class="mt-2">
    </div>
</form>