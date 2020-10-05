<?php
include 'mysql.php';
include 'files-manager.php';
include 'form-classes.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $data = get_formFromID($_GET['id']);
    $form = getOForm($data[1], $data[2]);

    date_default_timezone_set('UTC');
    if ($form->timed != null) {
        if ($date == null) {
            $time = time() + strtotime('1970-01-01 '.$form->hour);
        } else {
            $time = strtotime($form->date . ' ' . $form->hour);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <script src="jquery-3.5.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebForms - <?php echo $form->title; ?></title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="formBlocks.css">
    <link rel="stylesheet" href="hide-header.css">


    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'pt-PT',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="main.js"></script>

</head>

<body>
    <header></header>

    <div id="head">
        <table>
            <tr>
                <th>
                    <h1 style="text-align:left;"><?php echo $form->title; ?></h1>
                </th>
            </tr>
        </table>
    </div>

    <div style="text-align:center">
        <section id="form">
            <form id="formBlocks" method="post" action="submitForm.php">
            <input style="width:10px;float:right;visibility:hidden;" type="text" name="id" id="id" onclick="this.focus();this.select()" readonly="readonly" value="<?php echo $_GET["id"]; ?>"></td>

                <div id="form-content">
                    <h3><?php echo $form->description; ?></h3>
                </div>
                <button type="submit" style="float:right;" class="rect obtn">Submeter</button>
            </form>
        </section>
    </div>

    <footer></footer>

    <script type="text/javascript" src="form.js"></script>

    <script>
        $(document).ready(function() {
            let spaceSize = $(document).height() - $('#form').height() - 700;
            $('footer').css('margin-top', spaceSize);

            $('header').hover(function() {
                $('#header').slideDown()
            }, function() {
                $('#header').slideUp()
            })


            <?php
            foreach ($form->pages[0]->blocks as $key => $block) {
                $html = $form->print(0, $key);
                echo "$('#form-content').append('" . $html . "');";
            }
            ?>
            $('.trash').remove();


            $('.temp').prop('disabled', true);
            $('#timed').on('change', function() {
                $('.temp').prop('disabled', !($(this).prop("checked")));
            });

            $('#date').prop('disabled', true);
            $('.temp').on('change', function() {
                $('#date').prop('disabled', function() {
                    if ($('#temp_type2').is(':checked')) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });

            $('#date').prop('min', new Date().toJSON.split('T')[0]);

        });
        setInterval(function() {
            let d = new Date();
            let n = d.getTime();
            if (n / 1000 >= <?php echo $time; ?>) {
                $('#formBlocks').submit();
            }
        }, 60000);
    </script>
</body>

</html>