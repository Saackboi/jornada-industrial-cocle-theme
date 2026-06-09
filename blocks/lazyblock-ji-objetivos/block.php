<?php
$title = $attributes['title'] ?? 'Nuestros Objetivos';
$objectives = $attributes['objectives'] ?? [];

// Default data if empty
if ( empty( $objectives ) ) {
    $objectives = [
        ['obj_title' => 'Mentalidad Emprendedora', 'obj_desc' => 'Promover la mentalidad emprendedora entre estudiantes y profesionales...'],
        ['obj_title' => 'Tecnologías Emergentes', 'obj_desc' => 'Facilitar el conocimiento de las tecnologías que están transformando el sector...'],
        ['obj_title' => 'Experiencias Prácticas', 'obj_desc' => 'Ofrecer a los participantes experiencias prácticas y talleres interactivos...'],
        ['obj_title' => 'Colaboración', 'obj_desc' => 'Crear un espacio donde estudiantes y profesionales de diferentes disciplinas puedan colaborar...'],
        ['obj_title' => 'Recursos Clave', 'obj_desc' => 'Brindar a los participantes acceso a recursos clave como contactos, mentorías, y herramientas...'],
    ];
}
?>

<div class="ji-objetivos">
    <div class="ji-objetivos__header">
        <h2 class="ji-objetivos__main-title"><?php echo esc_html($title); ?></h2>
    </div>

    <div class="ji-objetivos__grid">
        <?php foreach ( $objectives as $index => $obj ) : 
            $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            $o_title = esc_html($obj['obj_title'] ?? '');
            $o_desc = esc_html($obj['obj_desc'] ?? '');
            
            // Layout specific classes (Bento box style)
            $card_class = 'ji-objetivos__card';
            if ($index === 0 || $index === 3) {
                $card_class .= ' ji-objetivos__card--large';
            }
        ?>
            <div class="<?php echo $card_class; ?>">
                <div class="ji-objetivos__card-bg-number"><?php echo $num; ?></div>
                <div class="ji-objetivos__card-content">
                    <span class="ji-objetivos__card-index">0<?php echo $index + 1; ?></span>
                    <h3 class="ji-objetivos__card-title"><?php echo $o_title; ?></h3>
                    <p class="ji-objetivos__card-desc"><?php echo $o_desc; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
