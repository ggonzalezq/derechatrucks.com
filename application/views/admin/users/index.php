<?php require_once FCPATH . 'application/views/admin/templates/header.php'; ?>
<div id="content-header">
    <h1>Usuarios</h1>
</div><!--#/content-header-->
<div id="breadcrumb">
    <a href="/admin/"><i class="icon-home"></i>Inicio</a>
    <a href="/admin/users" class="current">Usuarios</a>
</div>
<div class="container-fluid">
    <?php if( $arAlert ): ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="alert <?php echo $arAlert['class']; ?>">
                <button class="close" data-dismiss="alert">×</button>
                <?php echo $arAlert['message']; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="users-buffer">
                    <thead>
                        <tr>
                            <th id="user-username">Nombre de usuario</th>
                            <th id="user-group">Grupo</th>
                            <th id="user-name">Nombre</th>
                            <th id="user-email">Email</th>
                            <th id="user-telephone">Teléfono</th>
                            <th id="user-date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $arUsers as $arUser ): ?>
                        <tr id="user-<?php echo $arUser['id']; ?>">
                            <td>
                                <a href="/admin/users/user-edit/<?php echo $arUser['id']; ?>"><?php echo $arUser['username']; ?></a>
                                <ul class="clearfix buffer-options">
                                    <li><a href="/admin/users/user-edit/<?php echo $arUser['id']; ?>" class="btn btn-success btn-mini">Editar</a></li>
                                    <?php if( $arUser['active'] ): ?>
                                    <li><a href="/admin/users/user-deactivate/<?php echo $arUser['id']; ?>" class="btn btn-danger btn-mini">Desactivar</a></li>
                                    <?php else: ?>
                                    <li><a href="/admin/users/user-activate/<?php echo $arUser['id']; ?>" class="btn btn-info btn-mini">Activar</a></li>
                                    <?php endif; ?>
                                </ul>
                            </td>
                            <td><?php echo $arUser['group']; ?></td>
                            <td><?php echo implode( ' ', array( $arUser['first_name'], $arUser['last_name'] ) ); ?></td>
                            <td><a href="mailto:<?php echo $arUser['email']; ?>"><?php echo $arUser['email']; ?></a></td>
                            <td><?php echo $arUser['phone']; ?></td>
                            <td>
                                <p><?php echo $arUser['created_on']; ?></p>
                                <p>Creado</p>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php require_once FCPATH . 'application/views/admin/templates/footer.php'; ?>
