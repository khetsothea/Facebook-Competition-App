<table class="table table-striped">  
    <thead>  
        <tr>  
            <th>Name</th> 
            <th>Entries</th>
            <th>Active</th>  
            <th>Edit</th>  
            <th>Delete</th>  
        </tr>  
    </thead>  
    <tbody>  

        <?php foreach ($competitions as $comps) { ?>
            <tr>  
                <td><?php echo $comps->name; ?></td>
                <td></td>
                <td><?php if($comps->active == 1){ echo "YES";} else {echo "NO"; } ?></td>
                <td></td>
                <td></td>

            </tr>  
        <? } ?>
    </tbody>


