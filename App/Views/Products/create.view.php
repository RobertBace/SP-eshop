<?php
/** @var \App\Models\Product $data */
if ($data->getId()) { ?>
    <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-7 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <form method="post" action="?c=products&a=store" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Brand: *</label>
                            <select class="form-select" name="title" required>

                                <option value="" selected disabled>Please select</option>

                                <?php
                                $brandsData = \App\Models\Brand::getAll();
                                foreach ($brandsData as $brand) { ?>
                                    <option><?php echo $brand->getName() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Class</label>
                            <input type="text" maxlength="40" class="form-control" name="subclass"
                                   value="<?php echo $data->getSubclass() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price: *</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="price"
                                   value="<?php echo $data->getPrice() ?>">
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                <?php if ($data->getType() == null) { ?>
                                    <option value="" selected disabled>Please select</option>
                                <?php } else { ?>
                                    <option value="<?php echo $data->getType() ?>"></option>
                                <?php } ?>

                                <?php if ($data->getType() != "cestny") { ?>
                                    <option>cestny</option>
                                <?php } ?>

                                <?php if ($data->getType() != "horsky") { ?>
                                    <option>horsky</option>
                                <?php } ?>

                                <?php if ($data->getType() != "ebike") { ?>
                                    <option>ebike</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                   value="<?php echo $data->getDescription() ?>">
                        </div>
                    </form>
                    <div>
                        <form method="post">
                            <input type="file" name="img">
                        </form>
                    </div>
                    <input type="submit" value="odoslať" class="mt-2">
                </div>
            </div>
        </div>
    </div>
</div>