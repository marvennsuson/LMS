
<?php foreach ($getFile as $getFile_row): ?>
<iframe height="700px auto"  width="100% auto" src="<?=  base_url('public/uploads/Ebooks/').$getFile_row["filename"]?>" ></iframe>
<?php endforeach; ?>
