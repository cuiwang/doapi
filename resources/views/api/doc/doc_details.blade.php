@extends('common.base_layout')
@section('title',$doc->doc_title?$doc->doc_title:$project->name.' - 接口文档')
@section('stylesheet')
@section('stylesheet')
        <!-- Le styles -->
<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
{{--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
{{--<link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}
<!--custom风格-->
<link rel="stylesheet" href="{{asset('css/docs.min.css')}}">

    @endsection
    @section('content')


<div style="background-image: url('{{asset('assets/img/').'/'.$doc->doc_backgdimg}}');background-repeat: round">

    <!-- Docs page layout -->
    <div class="bs-docs-header" id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <img src="{{$project->iconimg}}" width="116px" height="116px" alt=""/>
                </div>
                <div class="col-sm-10" style="min-height: 116px;">
                    <h1>{{$doc->doc_title?$doc->doc_title:$project->name}}</h1>
                    <small class="pull-right" style="color: #555">版本号 : {{$doc->doc_version?$doc->doc_version:'1.0'}}</small>
                    <p>{{$doc->doc_description?$doc->doc_description:' 本文档由 Do API  动态生成,您可以实时查看文档最新状态,并分享给其他小伙伴.'}}</p>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" role="complementary">
                <ul class="nav bs-docs-sidenav">

                    <li>
                        <a href="#overview">概览</a>
                        <ul class="nav">
                            <li><a href="#overview-description">产品介绍</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#apidetails">接口详情</a>
                        <ul class="nav">
                            <li><a href="#static_api">静态接口</a></li>
                            @foreach($apis as $api)
                                <li><a href="#{{'api_'.$api->id}}">{{$api->description?:$api->url}}</a></li>
                            @endforeach
                        </ul>
                        <ul class="nav">
                            <li><a href="#dynamic_api">动态接口</a></li>
                            @foreach($dynamic_apis as $api)
                                <li><a href="#{{'api_'.$api->id}}">{{$api->url}}</a></li>
                            @endforeach
                        </ul>
                    </li>

                </ul>
                <a class="back-to-top" href="#top">
                    返回顶部
                </a>

            </div>
        </div>
        <div class="col-md-10" role="main" style="padding-left: 120px;background: #fff">
            <div class="bs-docs-section">
                <h1 id="overview" class="page-header">概览</h1>

                <h3 id="overview-description">产品介绍</h3>

                <h4 style="margin: 20px;color: #666;">{{$project->description}}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li><p class="lead">产品名称: <strong>{{$project->url}}</strong></p></li>
                            <li><p class="lead">产品接口数量: <strong>{{$apis_count}}</strong> 个</p></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li><p class="lead">产品创建时间: <strong>{{$project->created_at}}</strong></p></li>
                            <li><p class="lead">产品最后修改时间: <strong>{{$project->updated_at->diffForHumans()}}</strong></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>

            </div>
            {{--静态接口--}}
            <div class="bs-docs-section">
                <h1 id="apidetails" class="page-header">接口详情</h1>
                <div id="static_api" class="well">静态接口</div>
                <?php $index = 0;?>
                @foreach($apis as $api)
                    <?php $index += 1;?>
                    <div class="content-wrap">
                        <div class="row">

                            <div class="col-sm-12">
                                <!-- BLANK PAGE-->
                                <div class="nest" id="Blank_PageClose">
                                    <div id="{{'api_'.$api->id}}" class="title-alt">
                                        <h6 style="color: #000;">{{$index}} . {{$api->description}}
                                        </h6>

                                        <div class="titleClose">
                                            <a class="gone" href="#Blank_PageClose">
                                                <span class="entypo-cancel"></span>
                                            </a>
                                        </div>
                                        <div class="titleToggle">
                                            <a class="nav-toggle-alt" href="#Blank_Page_Content">
                                                <span class="entypo-up-open"></span>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="body-nest" id="Blank_Page_Content">
                                        <br>
                                        <blockquote>
                                            <p><strong> {{$api->url}}</strong></p>
                                            <footer>
                                                @if ($doc->doc_baseurl)
                                                    <a id="url" href="{{$doc->doc_baseurl.'/'.$api->url}}" target="_blank">{{$doc->doc_baseurl.'/'.$api->url}}</a>
                                                    @else
                                                    <a id="url" href="{{env('APP_URL').'/test/'.$api->id.'_api/'.$api->url}}" target="_blank">{{$api->baseurl.$api->url}}</a>
                                                @endif
                                            </footer>
                                        </blockquote>
                                        <p>请求方式：{{$api->method}}</p>

                                        <p>请求参数：{{$api->param}}</p>

                                        <p>参数描述：{{$api->param_description}}</p>

                                        <p>当前状态: {{$api->status}}</p>

                                        <p>返回内容: </p>
											<pre class="pre-scrollable">{{$api->json}}</pre>
                                        <p>示例: </p>
                                        <ul id="myTab{{$index}}" class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#C{{$index}}" data-toggle="tab">
                                                    C
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#ObjectC{{$index}}" data-toggle="tab">
                                                    Objective-C
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#swift{{$index}}" data-toggle="tab">
                                                    Swift
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Java
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop{{$index}}">
                                                    <li><a href="#okhttp{{$index}}" tabindex="-1" data-toggle="tab">OkHttp</a></li>
                                                    <li><a href="#unirest{{$index}}" tabindex="-1" data-toggle="tab">Unirest</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#Csharp{{$index}}" data-toggle="tab">
                                                    C#
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myJSTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">JavaScript
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myJSTabDrop{{$index}}">
                                                    <li><a href="#jquery{{$index}}" tabindex="-1" data-toggle="tab">jQuery</a></li>
                                                    <li><a href="#xmlhttprequest{{$index}}" tabindex="-1" data-toggle="tab">XMLHttpRequest</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myPHPTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">PHP
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myPHPTabDrop{{$index}}">
                                                    <li><a href="#curl{{$index}}" tabindex="-1" data-toggle="tab">cURL</a></li>
                                                    <li><a href="#httpv1{{$index}}" tabindex="-1" data-toggle="tab">HTTP v1</a></li>
                                                    <li><a href="#httpv2{{$index}}" tabindex="-1" data-toggle="tab">HTTP v2</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myPYTHONTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Python
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myPYTHONTabDrop{{$index}}">
                                                    <li><a href="#httpclient{{$index}}" tabindex="-1" data-toggle="tab">http.client</a></li>
                                                    <li><a href="#requests{{$index}}" tabindex="-1" data-toggle="tab">Requests</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="mySHELLTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Shell
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="mySHELLTabDrop{{$index}}">
                                                    <li><a href="#shellcurl{{$index}}" tabindex="-1" data-toggle="tab">cURL</a></li>
                                                    <li><a href="#httpie{{$index}}" tabindex="-1" data-toggle="tab">HTTPie</a></li>
                                                    <li><a href="#wget{{$index}}" tabindex="-1" data-toggle="tab">Wget</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div id="myTabContent{{$index}}" class="tab-content">
                                            <div class="tab-pane fade in active" id="C{{$index}}">
                                                <pre class="pre-scrollable">
CURL *hnd = curl_easy_init();
curl_easy_setopt(hnd, CURLOPT_CUSTOMREQUEST, {{$api->method}});
curl_easy_setopt(hnd, CURLOPT_URL, "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
struct curl_slist *headers = NULL;
headers = curl_slist_append(headers, "content-type: application/x-www-form-urlencoded");
headers = curl_slist_append(headers, "accept: application/json");
curl_easy_setopt(hnd, CURLOPT_HTTPHEADER, headers);
curl_easy_setopt(hnd, CURLOPT_COOKIE, "foo=bar; bar=baz");
curl_easy_setopt(hnd, CURLOPT_POSTFIELDS, "foo=bar&bar=baz");
CURLcode ret = curl_easy_perform(hnd);
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="ObjectC{{$index}}">
                                                <pre class="pre-scrollable">
#import <Foundation/Foundation.h>

NSDictionary *headers = @{ @"cookie": @"foo=bar; bar=baz",
                                                    @"accept": @"application/json",
                                                    @"content-type": @"application/x-www-form-urlencoded" };

NSMutableData *postData = [[NSMutableData alloc] initWithData:[@"foo=bar" dataUsingEncoding:NSUTF8StringEncoding]];
[postData appendData:[@"&bar=baz" dataUsingEncoding:NSUTF8StringEncoding]];

NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:[NSURL URLWithString:@"{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}"]
                                                       cachePolicy:NSURLRequestUseProtocolCachePolicy
                                                   timeoutInterval:10.0];
[request setHTTPMethod:@"{{$api->method}}"];
[request setAllHTTPHeaderFields:headers];
[request setHTTPBody:postData];

NSURLSession *session = [NSURLSession sharedSession];
NSURLSessionDataTask *dataTask = [session dataTaskWithRequest:request
                                            completionHandler:^(NSData *data, NSURLResponse *response, NSError *error) {
                                                if (error) {
                                                    NSLog(@"%@", error);
                                                } else {
                                                    NSHTTPURLResponse *httpResponse = (NSHTTPURLResponse *) response;
                                                    NSLog(@"%@", httpResponse);
                                                }
                                            }];
[dataTask resume];
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="swift{{$index}}">
                                                <pre class="pre-scrollable">
import Foundation

let headers = [
  "cookie": "foo=bar; bar=baz",
  "accept": "application/json",
  "content-type": "application/x-www-form-urlencoded"
]

var postData = NSMutableData(data: "foo=bar".dataUsingEncoding(NSUTF8StringEncoding)!)
postData.appendData("&bar=baz".dataUsingEncoding(NSUTF8StringEncoding)!)

var request = NSMutableURLRequest(URL: NSURL(string: "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")!,
                                        cachePolicy: .UseProtocolCachePolicy,
                                    timeoutInterval: 10.0)
request.HTTPMethod = "{{$api->method}}"
request.allHTTPHeaderFields = headers
request.HTTPBody = postData

let session = NSURLSession.sharedSession()
let dataTask = session.dataTaskWithRequest(request, completionHandler: { (data, response, error) -> Void in
  if (error != nil) {
    println(error)
  } else {
    let httpResponse = response as? NSHTTPURLResponse
    println(httpResponse)
  }
})

dataTask.resume()
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="okhttp{{$index}}">
                                                <pre class="pre-scrollable">
OkHttpClient client = new OkHttpClient();

MediaType mediaType = MediaType.parse("application/x-www-form-urlencoded");
RequestBody body = RequestBody.create(mediaType, "foo=bar&bar=baz");
Request request = new Request.Builder()
  .url("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")
  .post(body)
  .addHeader("cookie", "foo=bar; bar=baz")
  .addHeader("accept", "application/json")
  .addHeader("content-type", "application/x-www-form-urlencoded")
  .build();

Response response = client.newCall(request).execute();
                                                </pre>
                                            </div>
                                            <div class="tab-pane fade" id="unirest{{$index}}">
                                                <pre class="pre-scrollable">
HttpResponse<String> response = Unirest.post("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")
                                                        .header("cookie", "foo=bar; bar=baz")
                                                        .header("accept", "application/json")
                                                        .header("content-type", "application/x-www-form-urlencoded")
                                                        .body("foo=bar&bar=baz")
                                                        .asString();
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="Csharp{{$index}}">
                                                <pre class="pre-scrollable">
var client = new RestClient("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
var request = new RestRequest(Method.{{$api->method}});
request.AddHeader("content-type", "application/x-www-form-urlencoded");
request.AddHeader("accept", "application/json");
request.AddCookie("foo", "bar");
request.AddCookie("bar", "baz");
request.AddParameter("application/x-www-form-urlencoded", "foo=bar&bar=baz", ParameterType.RequestBody);
IRestResponse response = client.Execute(request);
                                                </pre>
                                            </div>
                                            <div class="tab-pane fade" id="jquery{{$index}}">
                                                <pre class="pre-scrollable">
var settings = {
  "async": true,
  "crossDomain": true,
  "url": "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}",
  "method": "{{$api->method}}",
  "headers": {
    "cookie": "foo=bar; bar=baz",
    "accept": "application/json",
    "content-type": "application/x-www-form-urlencoded"
  },
  "data": {
    "foo": "bar",
    "bar": "baz"
  }
}

$.ajax(settings).done(function (response) {
  console.log(response);
});
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="xmlhttprequest{{$index}}">
                                                <pre class="pre-scrollable">
var data = "foo=bar&bar=baz";

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("{{$api->method}}", "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
xhr.setRequestHeader("cookie", "foo=bar; bar=baz");
xhr.setRequestHeader("accept", "application/json");
xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

xhr.send(data);
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="curl{{$index}}">
                                                <pre class="pre-scrollable">
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "{{$api->method}}",
  CURLOPT_POSTFIELDS => "foo=bar&bar=baz",
  CURLOPT_COOKIE => "foo=bar; bar=baz",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpv1{{$index}}">
                                                <pre class="pre-scrollable">
$request = new HttpRequest();
$request->setUrl('{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}');
$request->setMethod(HTTP_METH_{{$api->method}});

$request->setQueryData(array(
  'foo' => array(
    'bar',
    'baz'
  )
));

$request->setHeaders(array(
  'content-type' => 'application/x-www-form-urlencoded',
  'accept' => 'application/json'
));

$request->setCookies(array(
  'bar' => 'baz',
  'foo' => 'bar'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'foo' => 'bar',
  'bar' => 'baz'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpv2{{$index}}">
                                                <pre class="pre-scrollable">
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->append(new http\QueryString(array(
  'foo' => 'bar',
  'bar' => 'baz'
)));

$request->setRequestUrl('{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}');
$request->setRequestMethod('{{$api->method}}');
$request->setBody($body);

$request->setQuery(new http\QueryString(array(
  'foo' => array(
    'bar',
    'baz'
  )
)));

$request->setHeaders(array(
  'content-type' => 'application/x-www-form-urlencoded',
  'accept' => 'application/json'
));


$client->setCookies(array(
  'bar' => 'baz',
  'foo' => 'bar'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpclient{{$index}}">
                                                <pre class="pre-scrollable">
import http.client

conn = http.client.HTTPConnection("{{$doc->doc_baseurl}}")

payload = "foo=bar&bar=baz"

headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/x-www-form-urlencoded"
    }

conn.request("{{$api->method}}", "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}", payload, headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="requests{{$index}}">
                                                <pre class="pre-scrollable">
import requests

url = "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}"

querystring = {"foo":["bar","baz"]}

payload = "foo=bar&bar=baz"
headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/x-www-form-urlencoded"
    }

response = requests.request("{{$api->method}}", url, data=payload, headers=headers, params=querystring)

print(response.text)
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="shellcurl{{$index}}">
                                                <pre class="pre-scrollable">
curl --request {{$api->method}} \
  --url '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}' \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --cookie 'foo=bar; bar=baz' \
  --data 'foo=bar&bar=baz'
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpie{{$index}}">
                                                <pre class="pre-scrollable">
http --form {{$api->method}} '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}' \
  accept:application/json \
  content-type:application/x-www-form-urlencoded \
  cookie:'foo=bar; bar=baz' \
  foo=bar \
  bar=baz
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="wget{{$index}}">
                                                <pre class="pre-scrollable">
wget --quiet \
  --method {{$api->method}} \
  --header 'cookie: foo=bar; bar=baz' \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --body-data 'foo=bar&bar=baz' \
  --output-document \
  - '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}'
                                                </pre>
                                                </p>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF BLANK PAGE -->

                        </div>

                        <!-- /END OF CONTENT -->


                    </div>

                @endforeach



            </div>
            {{--动态接口--}}
            <div class="bs-docs-section">
                <div id="dynamic_api" class="well">动态接口</div>
                <?php $index = 0;?>
                @foreach($dynamic_apis as $api)
                    <?php $index += 1;?>
                    <div class="content-wrap">
                        <div class="row">

                            <div class="col-sm-12">
                                <!-- BLANK PAGE-->
                                <div class="nest" id="Blank_PageClose">
                                    <div id="{{'api_'.$api->id}}" class="title-alt">
                                        <h6 style="color: #000;">{{$index}} . {{$api->description}}
                                        </h6>

                                        <div class="titleClose">
                                            <a class="gone" href="#Blank_PageClose">
                                                <span class="entypo-cancel"></span>
                                            </a>
                                        </div>
                                        <div class="titleToggle">
                                            <a class="nav-toggle-alt" href="#Blank_Page_Content">
                                                <span class="entypo-up-open"></span>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="body-nest" id="Blank_Page_Content">
                                        <br>
                                        <blockquote>
                                            <p><strong> {{$api->url}}</strong></p>
                                            <footer>
                                                @if ($doc->doc_baseurl)
                                                    <a id="url" href="{{$doc->doc_baseurl.'/'.$api->url}}" target="_blank">{{$doc->doc_baseurl.'/'.$api->url}}</a>
                                                @else
                                                    <a id="url" href="{{env('APP_URL').'/test/'.$api->id.'_api/'.$api->url}}" target="_blank">{{$api->baseurl.$api->url}}</a>
                                                @endif
                                            </footer>
                                        </blockquote>
                                        <p>请求方式：{{$api->method}}</p>

                                        <p>请求参数：{{$api->param}}</p>

                                        <p>参数描述：{{$api->param_description}}</p>

                                        <p>当前状态: {{$api->status}}</p>

                                        <p>返回内容: </p>
                                        <pre class="pre-scrollable">{{$api->json_data}}</pre>
                                        <p>示例: </p>
                                        <ul id="myTab{{$index}}" class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#C{{$index}}" data-toggle="tab">
                                                    C
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#ObjectC{{$index}}" data-toggle="tab">
                                                    Objective-C
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#swift{{$index}}" data-toggle="tab">
                                                    Swift
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Java
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop{{$index}}">
                                                    <li><a href="#okhttp{{$index}}" tabindex="-1" data-toggle="tab">OkHttp</a></li>
                                                    <li><a href="#unirest{{$index}}" tabindex="-1" data-toggle="tab">Unirest</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#Csharp{{$index}}" data-toggle="tab">
                                                    C#
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myJSTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">JavaScript
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myJSTabDrop{{$index}}">
                                                    <li><a href="#jquery{{$index}}" tabindex="-1" data-toggle="tab">jQuery</a></li>
                                                    <li><a href="#xmlhttprequest{{$index}}" tabindex="-1" data-toggle="tab">XMLHttpRequest</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myPHPTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">PHP
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myPHPTabDrop{{$index}}">
                                                    <li><a href="#curl{{$index}}" tabindex="-1" data-toggle="tab">cURL</a></li>
                                                    <li><a href="#httpv1{{$index}}" tabindex="-1" data-toggle="tab">HTTP v1</a></li>
                                                    <li><a href="#httpv2{{$index}}" tabindex="-1" data-toggle="tab">HTTP v2</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="myPYTHONTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Python
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="myPYTHONTabDrop{{$index}}">
                                                    <li><a href="#httpclient{{$index}}" tabindex="-1" data-toggle="tab">http.client</a></li>
                                                    <li><a href="#requests{{$index}}" tabindex="-1" data-toggle="tab">Requests</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" id="mySHELLTabDrop{{$index}}" class="dropdown-toggle"
                                                   data-toggle="dropdown">Shell
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="mySHELLTabDrop{{$index}}">
                                                    <li><a href="#shellcurl{{$index}}" tabindex="-1" data-toggle="tab">cURL</a></li>
                                                    <li><a href="#httpie{{$index}}" tabindex="-1" data-toggle="tab">HTTPie</a></li>
                                                    <li><a href="#wget{{$index}}" tabindex="-1" data-toggle="tab">Wget</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div id="myTabContent{{$index}}" class="tab-content">
                                            <div class="tab-pane fade in active" id="C{{$index}}">
                                                <pre class="pre-scrollable">
CURL *hnd = curl_easy_init();
curl_easy_setopt(hnd, CURLOPT_CUSTOMREQUEST, {{$api->method}});
curl_easy_setopt(hnd, CURLOPT_URL, "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
struct curl_slist *headers = NULL;
headers = curl_slist_append(headers, "content-type: application/x-www-form-urlencoded");
headers = curl_slist_append(headers, "accept: application/json");
curl_easy_setopt(hnd, CURLOPT_HTTPHEADER, headers);
curl_easy_setopt(hnd, CURLOPT_COOKIE, "foo=bar; bar=baz");
curl_easy_setopt(hnd, CURLOPT_POSTFIELDS, "foo=bar&bar=baz");
CURLcode ret = curl_easy_perform(hnd);
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="ObjectC{{$index}}">
                                                <pre class="pre-scrollable">
#import <Foundation/Foundation.h>

NSDictionary *headers = @{ @"cookie": @"foo=bar; bar=baz",
                                                    @"accept": @"application/json",
                                                    @"content-type": @"application/x-www-form-urlencoded" };

NSMutableData *postData = [[NSMutableData alloc] initWithData:[@"foo=bar" dataUsingEncoding:NSUTF8StringEncoding]];
[postData appendData:[@"&bar=baz" dataUsingEncoding:NSUTF8StringEncoding]];

NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:[NSURL URLWithString:@"{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}"]
                                                       cachePolicy:NSURLRequestUseProtocolCachePolicy
                                                   timeoutInterval:10.0];
[request setHTTPMethod:@"{{$api->method}}"];
[request setAllHTTPHeaderFields:headers];
[request setHTTPBody:postData];

NSURLSession *session = [NSURLSession sharedSession];
NSURLSessionDataTask *dataTask = [session dataTaskWithRequest:request
                                            completionHandler:^(NSData *data, NSURLResponse *response, NSError *error) {
                                                if (error) {
                                                    NSLog(@"%@", error);
                                                } else {
                                                    NSHTTPURLResponse *httpResponse = (NSHTTPURLResponse *) response;
                                                    NSLog(@"%@", httpResponse);
                                                }
                                            }];
[dataTask resume];
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="swift{{$index}}">
                                                <pre class="pre-scrollable">
import Foundation

let headers = [
  "cookie": "foo=bar; bar=baz",
  "accept": "application/json",
  "content-type": "application/x-www-form-urlencoded"
]

var postData = NSMutableData(data: "foo=bar".dataUsingEncoding(NSUTF8StringEncoding)!)
postData.appendData("&bar=baz".dataUsingEncoding(NSUTF8StringEncoding)!)

var request = NSMutableURLRequest(URL: NSURL(string: "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")!,
                                        cachePolicy: .UseProtocolCachePolicy,
                                    timeoutInterval: 10.0)
request.HTTPMethod = "{{$api->method}}"
request.allHTTPHeaderFields = headers
request.HTTPBody = postData

let session = NSURLSession.sharedSession()
let dataTask = session.dataTaskWithRequest(request, completionHandler: { (data, response, error) -> Void in
  if (error != nil) {
    println(error)
  } else {
    let httpResponse = response as? NSHTTPURLResponse
    println(httpResponse)
  }
})

dataTask.resume()
                                                </pre>

                                            </div>
                                            <div class="tab-pane fade" id="okhttp{{$index}}">
                                                <pre class="pre-scrollable">
OkHttpClient client = new OkHttpClient();

MediaType mediaType = MediaType.parse("application/x-www-form-urlencoded");
RequestBody body = RequestBody.create(mediaType, "foo=bar&bar=baz");
Request request = new Request.Builder()
  .url("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")
  .post(body)
  .addHeader("cookie", "foo=bar; bar=baz")
  .addHeader("accept", "application/json")
  .addHeader("content-type", "application/x-www-form-urlencoded")
  .build();

Response response = client.newCall(request).execute();
                                                </pre>
                                            </div>
                                            <div class="tab-pane fade" id="unirest{{$index}}">
                                                <pre class="pre-scrollable">
HttpResponse<String> response = Unirest.post("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}")
                                                        .header("cookie", "foo=bar; bar=baz")
                                                        .header("accept", "application/json")
                                                        .header("content-type", "application/x-www-form-urlencoded")
                                                        .body("foo=bar&bar=baz")
                                                        .asString();
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="Csharp{{$index}}">
                                                <pre class="pre-scrollable">
var client = new RestClient("{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
var request = new RestRequest(Method.{{$api->method}});
request.AddHeader("content-type", "application/x-www-form-urlencoded");
request.AddHeader("accept", "application/json");
request.AddCookie("foo", "bar");
request.AddCookie("bar", "baz");
request.AddParameter("application/x-www-form-urlencoded", "foo=bar&bar=baz", ParameterType.RequestBody);
IRestResponse response = client.Execute(request);
                                                </pre>
                                            </div>
                                            <div class="tab-pane fade" id="jquery{{$index}}">
                                                <pre class="pre-scrollable">
var settings = {
  "async": true,
  "crossDomain": true,
  "url": "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}",
  "method": "{{$api->method}}",
  "headers": {
    "cookie": "foo=bar; bar=baz",
    "accept": "application/json",
    "content-type": "application/x-www-form-urlencoded"
  },
  "data": {
    "foo": "bar",
    "bar": "baz"
  }
}

$.ajax(settings).done(function (response) {
  console.log(response);
});
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="xmlhttprequest{{$index}}">
                                                <pre class="pre-scrollable">
var data = "foo=bar&bar=baz";

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("{{$api->method}}", "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}");
xhr.setRequestHeader("cookie", "foo=bar; bar=baz");
xhr.setRequestHeader("accept", "application/json");
xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");

xhr.send(data);
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="curl{{$index}}">
                                                <pre class="pre-scrollable">
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "{{$api->method}}",
  CURLOPT_POSTFIELDS => "foo=bar&bar=baz",
  CURLOPT_COOKIE => "foo=bar; bar=baz",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpv1{{$index}}">
                                                <pre class="pre-scrollable">
$request = new HttpRequest();
$request->setUrl('{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}');
$request->setMethod(HTTP_METH_{{$api->method}});

$request->setQueryData(array(
  'foo' => array(
    'bar',
    'baz'
  )
));

$request->setHeaders(array(
  'content-type' => 'application/x-www-form-urlencoded',
  'accept' => 'application/json'
));

$request->setCookies(array(
  'bar' => 'baz',
  'foo' => 'bar'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'foo' => 'bar',
  'bar' => 'baz'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpv2{{$index}}">
                                                <pre class="pre-scrollable">
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->append(new http\QueryString(array(
  'foo' => 'bar',
  'bar' => 'baz'
)));

$request->setRequestUrl('{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}');
$request->setRequestMethod('{{$api->method}}');
$request->setBody($body);

$request->setQuery(new http\QueryString(array(
  'foo' => array(
    'bar',
    'baz'
  )
)));

$request->setHeaders(array(
  'content-type' => 'application/x-www-form-urlencoded',
  'accept' => 'application/json'
));


$client->setCookies(array(
  'bar' => 'baz',
  'foo' => 'bar'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpclient{{$index}}">
                                                <pre class="pre-scrollable">
import http.client

conn = http.client.HTTPConnection("{{$doc->doc_baseurl}}")

payload = "foo=bar&bar=baz"

headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/x-www-form-urlencoded"
    }

conn.request("{{$api->method}}", "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}", payload, headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="requests{{$index}}">
                                                <pre class="pre-scrollable">
import requests

url = "{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}"

querystring = {"foo":["bar","baz"]}

payload = "foo=bar&bar=baz"
headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/x-www-form-urlencoded"
    }

response = requests.request("{{$api->method}}", url, data=payload, headers=headers, params=querystring)

print(response.text)
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="shellcurl{{$index}}">
                                                <pre class="pre-scrollable">
curl --request {{$api->method}} \
  --url '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}' \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --cookie 'foo=bar; bar=baz' \
  --data 'foo=bar&bar=baz'
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="httpie{{$index}}">
                                                <pre class="pre-scrollable">
http --form {{$api->method}} '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}' \
  accept:application/json \
  content-type:application/x-www-form-urlencoded \
  cookie:'foo=bar; bar=baz' \
  foo=bar \
  bar=baz
                                                </pre>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="wget{{$index}}">
                                                <pre class="pre-scrollable">
wget --quiet \
  --method {{$api->method}} \
  --header 'cookie: foo=bar; bar=baz' \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --body-data 'foo=bar&bar=baz' \
  --output-document \
  - '{{$doc->doc_baseurl?$doc->doc_baseurl.'/'.$api->url:$api->baseurl.$api->url}}'
                                                </pre>
                                                </p>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF BLANK PAGE -->

                        </div>

                        <!-- /END OF CONTENT -->


                    </div>

                @endforeach



            </div>
            <!-- 底部 -->
            <footer class="footer pull-right" style="background: #fff;">
                <div class="container">
                    <div class="text-center">
                        <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-2</p>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</div>


<!-- /END OF CONTENT -->
@endsection
@section('javascript')
<!-- MAIN EFFECT -->
{{--<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>--}}
{{--<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
<!-- /MAIN EFFECT -->
<script type="text/javascript" src="{{asset('js/docs.min.js')}}"></script>

@endsection