<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
        #page-wrapper-modal {
            margin-bottom: 20px;
        }

        #page-wrapper-modal .list-document {
            list-style: none;
        }

        #page-wrapper-modal .list-document .item {
            float: left;
            margin: 5px;
            width: 23%;
        }

        #page-wrapper-modal .list-document .item div {
            text-align: center;
        }

        #page-wrapper-modal .list-document .item div span {
            word-wrap: break-word;
        }
    </style>

</head>
<body>
    
    <div id="page-wrapper-modal">
        <div class="container-fluid">
            <br/>
            <div class="model-document-title">Documents</div>
            <div class="model-document-content">
                <ul class="list-document row">
                @php
                #echo '<pre>';
                #print_r($documentExtention);
                #print_r($documents);
                #echo '</pre>';
                #exit;
                @endphp

                @foreach ($documents as $key => $document)

                    @php
                        $other = array_pop($listIcon);
                        if (isset($listIcon[$documentExtention[$key]])) {
                            $src = $listIcon[$documentExtention[$key]];
                        } else {
                            $src = $other;
                        }
                    @endphp
                    
                    <li class="item col-md-3">
                        <a href="{{ url($document) }}">
                            <div>
                                <img style=" height: 100px; width: 100px;" class="avatar avatar-preview img-circle" src="{{ $src }}">
                            </div>
                            <div>
                                <span>{{ $document }}</span>
                            </div>
                        </a>
                    </li>   
                    

                @endforeach
                </ul>

                <div class="clear"></div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
</body>
</html>

