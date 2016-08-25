<?php
$i = 1;
?>
<div class="documents-view">
    <h1>Документы</h1>
    <?php if (!empty($data)) { ?>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item) : ?>
            <?php
            $info = pathinfo($item);
            $size = ceil(filesize($item)/1024);
            $name = str_replace('../web/files/documents/', '', $item);
            ?>
            <tr>
                <td><b><?php echo $i ?></b></td>
                <td class="text-center"><?php echo $name ?></td>
                <td width="20%">
                    <a href="/files/documents/<?php echo $name ?>" class="text-center link-file" target="_blank">
                        <div><span class="glyphicon glyphicon-download"></span></div>
                        <div>Скачать</div>
                        <div>[<?php echo $info['extension'] . ', ' . $size ?> Кб]</div>
                    </a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php } else { ?>
        <p></p>
        <h4>Нет файлов</h4>
    <?php } ?>
</div>