<table border="0" cellspacing="0" cellpadding="0" width="100%"
       style="-webkit-text-size-adjust:100%;mso-table-rspace:0pt;mso-table-lspace:0pt;-ms-text-size-adjust:100%;">
    <tbody>
    <tr>
        <td align="left" id="qatest-hero-headline" colspan="2"
            style="-webkit-text-size-adjust:100%;mso-table-rspace:0pt;mso-table-lspace:0pt;-ms-text-size-adjust:100%;padding-bottom:12px;">
            <h3 >
                {{base64_decode($invitationUser->name)}},{{base64_decode($user->name)}}诚挚的邀请您参与(<b>{{$project->name}}</b>)产品的维护与开发.
            </h3>
        </td>
    </tr>

    <tr>
        <td >
            <h4>产品基本信息:</h4>
            <p >{{$project->name}}</p>
            <p >{{$project->description}}</p>
            <p>上次更新: {{$project->updated_at}}</p>

            <p><br>
                此产品接口文档,部署在下面的地址,点击查看:</p>
            <a href="https://doapi.cn/i/{{$project->url}}/doc" style="text-decoration: none">https://doapi.cn/i/{{$project->url}}/doc</a>

            <p>
                <br><br>
                <a
                        href="https://doapi.cn/i/{{$project->url}}/view_AcceptEmailInvitation/{{$invitationUser->email}}"
                        target="_blank"
                        style="background-color: #008CC9;color: #fff;padding: 10px;">接受邀请</a>
            </p>
        </td>
    </tr>

    <tr>
        <td>


            <h6 style="float: right"><br>由https://doapi.cn提供服务支持</h6>
        </td>
    </tr>


    </tbody>
</table>
