<!DOCTYPE html>
<html lang="en">
<head>
<?= view('templates/header.php')?>
</head>

<body>
<section id="main-section">
    <div class="container-fluid">
        <div class="row">
            <?= $this->renderSection('left-section')?>
            <?= $this->renderSection('right-section')?>
        </div>
        <?= $this->renderSection('mainbody-section')?>
    </div>
</section>
<?= view('templates/footer.php')?>
</body>
</html>


