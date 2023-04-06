@extends('layouts.app')

@section('content')
<style>
</style>
    <div class="mt-5" style="width:80%;">
        <div style="mr-5 ml-5">
            <table style="width:200px;">
                <tbody>
                    <tr>
                        <td width="50px;">Menu</td>
                        <td width="50px;">Read</td>
                        <td width="50px;">Write</td>
                        <td width="50px;">Delete</td>
                    </tr>
                </tbody>
            </table>
            @for ($i = 0; $i < 20; $i++)
                <table style="width:100px;">
                    <tbody>
                        <tr>
                            @foreach ($value as $key=>$item)
                                <td width="50px" style="text-align:center; vertical-align: middle;">
                                    <input type="checkbox" value="1" id="<?php echo $i; ?>" />
                                </td>
                                
                            @endforeach



                        </tr>
            @endfor
            </tbody>
            </table>


        </div>
    </div>
@endsection
