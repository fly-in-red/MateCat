<?
require_once '../../inc/config.inc.php';
INIT::obtain();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>API - Matecat</title>
    <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/public/css/manage.css" rel="stylesheet" type="text/css" />
    <link href="/public/css/common.css" rel="stylesheet" type="text/css" />
    <script src="/public/js/lib/jquery.js"></script>
</head>
<body class="api">
<header>
    <div class="wrapper ">
        <a href="/" class="logo"></a>
    </div>
</header>
<div id="contentBox" class="wrapper">
    <div class="colsx">
    	<a href="#top"><span class="logosmall"></span></a>
            <h1>API</h1>
                <ul class="menu">
                    <li><a href="#new-post">/new (POST)</a></li>
                    <li><a href="#status-post">/status (GET)</a></li>
                    <li><a href="#change_project_password-post">/change_project_password (POST)</a></li>
                    <li><a href="#file-format">Supported file format</a></li>
                     <li><a href="#languages">Supported languages</a></li>
                </ul>
        </div>
    <div class="coldx">
        <a name="top" class="top"></a>
            <div class="block">
                <a name="new-post"><h3 class="method-title">/new (POST)</h3></a>
                <dl>
                    <dt>Description</dt>
                    <dd><p>Create a new Project.</p>
                    </dd>
                    <dt class="url-label">URL Structure</dt>
                    <dd>
                        <pre class="literal-block"><?=INIT::$HTTPHOST . INIT::$BASEURL?><b>api</b>/new</pre>
                    </dd>
                    <dt>Method</dt>
                    <dd>POST ( multipart/form-data )</dd>
                    <dt>Files To Upload</dt>
                    <dd><p><span class="req">required</span> The file(s) to be uploaded.</p></dd>
                    <dt>Parameters</dt>
                    <dd>
                        <ul class="parameters">
                            <li><span class="req">required</span> <code class="param">project_name</code> <code>(string)</code> The name of the project you want
                                create.
                            </li>
                            <li><span class="req">required</span> <code class="param">source_lang</code> <code>(string)</code> <a href="http://www.rfc-editor.org/rfc/rfc5646.txt" target="blank">RFC 5646</a> language+region Code ( en-US <b>case sensitive</b> ) as specified in <a href="http://www.w3.org/International/articles/language-tags/" target="blank">W3C standards</a>
                            </li>
                            <li><span class="req">required</span> <code class="param">target_lang</code> <code>(string)</code> <a href="http://www.rfc-editor.org/rfc/rfc5646.txt" target="blank">RFC 5646</a> language(s)+region(s) Code(s)  as specified in <a href="http://www.w3.org/International/articles/language-tags/" target="blank">W3C standards</a>.
                                <br />Multiple languages must be comma separated ( <code>it-IT,fr-FR,es-ES</code> <b>case sensitive</b>)
                            </li>
                            <li><span class="opt">optional (default 1)</span> <code class="param">tms_engine</code> <code>(int)</code> Identifier for Memory Server
                                <code>0</code> means disabled, <code>1</code> means MyMemory)
                            </li>
                            <li><span class="opt">optional (default 1)</span> <code class="param"> mt_engine</code> <code>(int)</code> Identifier for Machine Translation Service
                                <code>0</code> means disabled, <code>1</code> means get MT from MyMemory)
                            </li>
                            <li><span class="opt">optional</span> <code class="param"> private_tm_key</code> <code>(string)</code> Private Key for MyMemory.
                                <br />Fill this field with your MyMemory private key if you already have one or set to <code>new</code> to create a new one.
                            </li>
                        </ul>
                    </dd>
                    <dt>Returns</dt>
                    <dd>
                        <p>The metadata for the created project.</p>
                
                        <p>More information on the returned metadata fields are available
                            <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#metadata-new-details">here</a>
                        </p>
                
                        <p>A complete list of accepted languages in the right format are available
                            <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#supported-langs">here</a>
                        </p>
                
                        <p><strong>Sample JSON response</strong></p>
                            <pre class="literal-block">
{
    "status": "OK",
    "id_project": 5368,
    "project_pass": "76ba60c027b9",
}                           </pre>
                        <p><strong>Return value definitions</strong></p>
                        <table id="metadata-new-details" class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <th>field</th>
                                <th>description</th>
                            </tr>
                            <tr>
                                <td><code>status</code></td>
                                <td>Return the creation status of the project. The statuses can be:
                                    <ul>
                                        <li><code>OK</code> indicating that the creation worked.</li>
                                        <li><code>FAIL</code> indicating that the creation is failed.</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td><code>id_project</code></td>
                                <td>Return the unique id of the project just created.
                                    If creation status is <code>FAIL</code> this key will simply be omitted from the result.
                                </td>
                            </tr>
                            <tr>
                                <td><code>project_pass</code></td>
                                <td>Return the password of the project just created.
                                    If creation status is <code>FAIL</code> this key will simply be omitted from the result.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                
                   <p><strong>Errors</strong></p>
                        <table class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                
                            <tbody>
                             <tr>
                                <th>status</th>
                                <th>message</th>
                            </tr>
                            <tr>
                                <td>FAIL</td>
                                <td>The project creation is failed</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                        <pre class="literal-block">
{
	status: "FAIL"
	message: "Project Conversion Failure"
	debug: [2]
	0:  {
		code: -110
		message: "Error: there is a problem with this file, it cannot be converted back to the original one."
		debug: "TEST_FAILURE_DOC1.docx"
	}
	1:  {
		code: -100
		message: "Conversion error. Try opening and saving the document with a new name. If this does not work, try converting to DOC."
		debug: "TEST_FAILURE_DOC2.docx"
	}

}                                      </pre>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <p><strong>Debug Codes</strong></p>
                        <table class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tbody>
                            <tr>
                                <th>code</th>
                                <th>message</th>
                                <th>debug</th>
                            </tr>
                            <tr>
                                <td>-1</td>
                                <td>"Error: missing file name."</td>
                                <td>NULL</td>
                            </tr>
                            <tr>
                                <td>-6</td>
                                <td>"Error during upload. Please retry."</td>
                                <td>NULL</td>
                            </tr>
                            <tr>
                                <td>-100</td>
                                <td>"Conversion error. Try opening and saving the document with a new name. If this does not work, try converting to DOC."</td>
                                <td>The failed file name. </td>
                            </tr>
                            <tr>
                                <td>-101</td>
                                <td>"Error: failed to save converted file from cache to disk"</td>
                                <td>The failed file name. </td>
                            </tr>
                            <tr>
                                <td>-102</td>
                                <td>"Error: File too large"</td>
                                <td>The failed file name. </td>
                            </tr>
                            <tr>
                                <td>-103</td>
                                <td>"Error: failed to save file on disk"</td>
                                <td>The failed file name. </td>
                            </tr>
                            <tr>
                                <td>-110</td>
                                <td>"Error: there is a problem with this file, it cannot be converted back to the original one."</td>
                                <td>The failed file name. </td>
                            </tr>
                            </tbody>
                        </table>

                    </dd>
                    <dt>Notes</dt>
                    <dd><p><code>/new</code> has a maximum file size limit of 60 MB per file and a max number of files of 100.</p></dd>
                    <dd><p>Matecat PRO accept only 54 file formats. A list of all accepted file are available
                        <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#accepted-files">here</a></p>
                    </dd>
                </dl>
                
                <a class="gototop" href="#top">Go to top</a>
            </div>
            <div class="block">
                <a name="status-post"><h3 class="method-title">/status (GET)</h3></a>
                <dl>
                        <dt>Description</dt>
                        <dd><p>Retrieve the status of a project</p>
                        </dd>
                        <dt class="url-label">URL Structure</dt>
                        <dd>
                            <pre class="literal-block"><?=INIT::$HTTPHOST . INIT::$BASEURL?><b>api</b>/status/?<code>id_project=<12345></code>&<code>project_pass=<1abcde123></abcde123></code></pre>
                        </dd>
                        <dt>Method</dt>
                        <dd>GET</dd>
                        <dt>Parameters</dt>
                        <dd>
                            <ul class="parameters">
                                <li><span class="req">required</span> <code class="param"> id_project</code> <code>(int)</code> The identifier of the project, should be the
                                    value returned by the <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#new-post"><code>/new</code></a> method.
                                </li>
                                <li><span class="req">required</span> <code class="param"> project_pass</code> <code>(string)</code> The password associated with the project, should be the
                                    value returned by the <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#new-post"><code>/new</code></a> method ( associated with the id_project )
                                </li>
                            </ul>
                        </dd>
                        <dt>Returns</dt>
                        <dd>
                        <p>The metadata for the created project containing the status of the project.</p>
                        
                        <p>More information on the returned metadata fields are available
                            <a href="<?=INIT::$HTTPHOST . INIT::$BASEURL?>api/docs#metadata-status-details">here</a>
                        </p>
                        
                        <p><strong>Sample JSON response</strong></p>
                                    <pre class="literal-block">
{"data": {
    "jobs": {
        "5615": {
            "chunks": {
                "e77eeea779d2": {
                    "6291": {
                        "TOTAL_PAYABLE":
                                [
                                    143.15
                                ],
                        "REPETITIONS":
                                [
                                    0,
                                    "0"
                                ],
                        "MT":
                                [
                                    166,
                                    "166"
                                ],
                        "NEW":
                                [
                                    0,
                                    "0"
                                ],
                        "TM_100":
                                [
                                    2,
                                    "2"
                                ],
                        "TM_75_99":
                                [
                                    1,
                                    "1"
                                ],
                        "INTERNAL_MATCHES":
                                [
                                    0,
                                    "0"
                                ],
                        "ICE":
                                [
                                    0,
                                    "0"
                                ],
                        "NUMBERS_ONLY":
                                [
                                    1,
                                    "1"
                                ],
                        "FILENAME": "Test1.docx"
                    }
                }
            },
            "totals": {
                "e77eeea779d2": {
                    "TOTAL_PAYABLE":
                            [
                                143.15,
                                "143"
                            ],
                    "REPETITIONS":
                            [
                                0,
                                "0"
                            ],
                    "MT":
                            [
                                166,
                                "166"
                            ],
                    "NEW":
                            [
                                0,
                                "0"
                            ],
                    "TM_100":
                            [
                                2,
                                "2"
                            ],
                    "TM_75_99":
                            [
                                1,
                                "1"
                            ],
                    "INTERNAL_MATCHES":
                            [
                                0,
                                "0"
                            ],
                    "ICE":
                            [
                                0,
                                "0"
                            ],
                    "NUMBERS_ONLY":
                            [
                                1,
                                "1"
                            ],
                    }
                }
            }
        },
        "summary": {
            "IN_QUEUE_BEFORE": 0,
            "STATUS": "DONE",
            "TOTAL_SEGMENTS": 16,
            "SEGMENTS_ANALYZED": 16,
            "TOTAL_FAST_WC": "169.00",
            "TOTAL_TM_WC": 143.15,
            "TOTAL_STANDARD_WC": 168.2,
            "STANDARD_WC_TIME": "27",
            "FAST_WC_TIME": "27",
            "TM_WC_TIME": "23",
            "STANDARD_WC_UNIT": "minutes",
            "TM_WC_UNIT": "minutes",
            "FAST_WC_UNIT": "minutes",
            "USAGE_FEE": "0.78",
            "PRICE_PER_WORD": "0.030",
            "DISCOUNT": "2",
            "NAME": "MyProject4",
            "TOTAL_RAW_WC": 170,
            "TOTAL_PAYABLE": 143.15,
            "PAYABLE_WC_TIME": "23",
            "PAYABLE_WC_UNIT": "minutes",
            "DISCOUNT_WC": "0"
        }
    },
   "status": "DONE",
   "analyze": "/analyze/MyProject4/5368-76ba60c027b9",
   "jobs": {
        "langpairs": {
                "5615-e77eeea779d2": "de-DE|en-US"
        },
       "job-url": {
            "5615-e77eeea779d2": "/translate/MyProject4/de-DE-en-US/5615-e77eeea779d2"
        }
   }
}                                   </pre>
                        <p><strong>Return value definitions</strong></p>
                        <table id="metadata-status-details" class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                            <tbody>
                            <tr>
                                <th>field</th>
                                <th>description</th>
                            </tr>
                            <tr>
                                <td><code>jobs</code></td>
                                <td>A structure containing all the info for the specified project.
                                    The numerical keys on the first level are the ID of the Jobs contained in the project.
                                    ( An ID identifies a language target, so, there are so many languages as there are IDs and vice versa  ).
                                </td>
                            </tr>
                            <tr>
                                <td><code>chunks</code></td>
                                <td>A structure containing the password for the associated job ID.
                                    There may be multiple chunks ( passwords ) for the same job ID because of the split.
                                    So this key can have multiple entries.
                                    Inside every entry key ( passwords ) whe have one or more numerical key indicating the id of every file in the chunk
                                </td>
                            </tr>
                            <tr>
                                <td><code>totals</code></td>
                                <td>Returns the total for every chunk. The entries inside this key are the sums of values for all the chunks of the job.</td>
                            </tr>
                            <tr>
                                <td><code>summary</code></td>
                                <td>Returns the total for the project.</td>
                            </tr>
                            <tr id="project-status">
                                <td><code>status</code></td>
                                <td>Return the analysis status of the project. The statuses can be:
                                    <ul>
                                        <li><code>ANALYZING</code> indicating that the analysis/creation still working.</li>
                                        <li><code>NO_SEGMENTS_FOUND</code> indicating that the project has no segments to analyze.</li>
                                        <li><code>ANALYSIS_NOT_ENABLED</code> indicating that no analysis will be performed because of matecat configurations.</li>
                                        <li><code>DONE</code> indicating that the analysis/creation is completed.</li>
                                        <li><code>FAIL</code> indicating that the analysis/creation is failed.</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td><code>analyze</code></td>
                                <td>A link to the analyze page where you can fine all these project info.</td>
                            </tr>
                            <tr>
                                <td><code>langpairs</code></td>
                                <td>The language pairs for every job/chunk in the project.
                                </td>
                            </tr>
                            <tr>
                                <td><code>job-url</code></td>
                                <td>An object containing all the links to the jobs of the project</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_PAYABLE</code></td>
                                <td>A field containing the number of matecat payable words count in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>REPETITIONS</code></td>
                                <td>A field containing the number of words repetition in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>INTERNAL_MATCHES</code></td>
                                <td>A field containing the number of partial matches found in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>MT</code></td>
                                <td>A field containing the number of matches by Machine Translation in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>NEW</code></td>
                                <td>A field containing the number of words not found in Machine Translations nor in Memory Server in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>TM_100</code></td>
                                <td>A field containing the number of exact matches found in Memory Server in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>TM_75_99</code></td>
                                <td>A field containing the number of matches found in the Memory Server scored between 75% and 99% in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>ICE</code></td>
                                <td>A field containing the number of exact matches in context found in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>NUMBERS_ONLY</code></td>
                                <td>A field containing only number, dates and similar not translatable data ( <br />Ex: 93/127 ) found in the project/chunk/file</td>
                            </tr>
                            <tr>
                                <td><code>IN_QUEUE_BEFORE</code></td>
                                <td>A field containing the number of segments in the analysis queue before the project and not relative to the project.</td>
                            </tr>
                            <tr>
                                <td><code>STATUS</code></td>
                                <td>A field containing the analysis status of the project. See <a href="#project-status" >status</a></td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_SEGMENTS</code></td>
                                <td>A field containing the total number of segments the project.</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_FAST_WC</code></td>
                                <td>A field containing the total number of words calculated in fast mode for the project.</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_TM_WC</code></td>
                                <td>A field containing the total number of segments found in the translation memory server.</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_STANDARD_WC</code></td>
                                <td>A field containing the total number of words calculated with standard word count system.</td>
                            </tr>
                            <tr>
                                <td><code>STANDARD_WC_TIME</code></td>
                                <td>A field containing the total number of words calculated with standard word count system.</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_RAW_WC</code></td>
                                <td>A field containing the total number of words calculated without any repetition check.</td>
                            </tr>
                            <tr>
                                <td><code>TOTAL_PAYABLE</code></td>
                                <td>A field containing the final total number of words calculated by Matecat.</td>
                            </tr>
                            </tbody>
                        </table>
                        </dd>
                        <dt>Errors</dt>
                        <dd>
                            <table class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                                <tbody>
                                <tr>
                                <th>field</th>
                                <th>description</th>
                            </tr>
                                <tr>
                                    <td>FAIL</td>
                                    <td>Wrong Password. Access denied</td>
                                </tr>
                                <tr>
                                    <td>FAIL</td>
                                    <td>No id project provided</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                                <pre class="literal-block">
{
    "status":  "FAIL",
    "message": "Wrong Password. Access denied"
}                                               </pre>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </dd>
                        </dl>
                        <a class="gototop" href="#top">Go to top</a>
			</div>

        <!-- change Password Block -->
        <div class="block">
            <a name="change_project_password-post"><h3 class="method-title">/change_project_password (POST)</h3></a>
            <dl>
                <dt>Description</dt>
                <dd><p>Change the password of a project.</p>
                </dd>
                <dt class="url-label">URL Structure</dt>
                <dd>
                    <pre class="literal-block"><?=INIT::$HTTPHOST . INIT::$BASEURL?><b>api</b>/change_project_password</pre>
                </dd>
                <dt>Method</dt>
                <dd>POST ( application/x-www-form-urlencoded )</dd>
                <dt>Parameters</dt>
                <dd>
                    <ul class="parameters">
                        <li><span class="req">required</span> <code class="param">id_project</code> <code>(int)</code>
                            The id of the project you want to update.
                        </li>
                        <li><span class="req">required</span> <code class="param">old_pass</code>
                            <code>(string)</code> The OLD password of the project you want to update.</a>
                        </li>
                        <li><span class="req">required</span> <code class="param">new_pass</code>
                            <code>(string)</code> The NEW password of the project you want to update.</a>
                        </li>
                    </ul>
                </dd>
                <dt>Returns</dt>
                <dd>
                    <p>The result status for the request.</p>

                    <p><strong>Sample JSON response</strong></p>
                                <pre class="literal-block">
{
    "status": "OK",
    "id_project": "5425",
    "project_pass": "3cde561e42d1"
}                              </pre>
                    <p><strong>Return value definitions</strong></p>
                    <table id="metadata-change_project_password" class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <th>field</th>
                            <th>description</th>
                        </tr>
                        <tr>
                            <td><code>status</code></td>
                            <td>Return the exit status of the action. The statuses can be:
                                <ul>
                                    <li>
                                        <code>OK</code> indicating that the action worked.
                                    </li>
                                    <li><code>FAIL</code> indicating that the action failed because of the project was
                                        not found.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td><code>id_project</code></td>
                            <td>Returns the id of the project just updated.</td>
                        </tr>
                        <tr>
                            <td><code>project_pass</code></td>
                            <td>Returns the new pass of the project just updated.</td>
                        </tr>
                        <tr>
                            <td><code>message</code></td>
                            <td>Return the error message for the action if the status is <code>FAIL</code></td>
                        </tr>
                        </tbody>
                    </table>

                    <p><strong>Errors</strong></p>
                    <table class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tbody>
                        <tr>
                            <th>status</th>
                            <th>message</th>
                        </tr>
                        <tr>
                            <td>FAIL</td>
                            <td>Wrong id or pass</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                            <pre class="literal-block">
{
    "status": "FAIL",
    "message": "Wrong id or pass"
}                                           </pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </dd>
            </dl>

            <a class="gototop" href="#top">Go to top</a>
        </div>
        <!-- END change Password Block -->

            <div class="block">
                    <a name="file-format"><h3 class="method-title">Supported file formats</h3></a>
                        
                        
                            <table class="tablestats fileformat" width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                                <thead>
                                <tr><th width="40%">Office</th>
                                    <th width="15%">Web</th>
                                    <th width="15%">Interchange Formats</th>
                                    <th width="15%">Desktop Publishing</th>
                                    <th width="15%">Localization</th>
                                </tr></thead>
                                <tbody><tr>
                                    <td>
                                        <ul class="office">
                                            <li><span class="extdoc">doc</span></li>
                                            <li><span class="extdoc">dot</span></li>
                                            <li><span class="extdoc">docx</span></li>
                                            <li><span class="extdoc">dotx</span></li>
                                            <li><span class="extdoc">docm</span></li>
                                            <li><span class="extdoc">dotm</span></li>
                                            <li><span class="extdoc">odt</span></li>
                                            <li><span class="extdoc">sxw</span></li>
                                            <li><span class="exttxt">txt</span></li>
                                            <li><span class="extpdf">pdf</span></li>
                                            <li><span class="extppt">pot</span></li>
                                            <li><span class="extppt">pps</span></li>
                                            <li><span class="extppt">ppt</span></li>
                                            <li><span class="extppt">potm</span></li>
                                            <li><span class="extppt">potx</span></li>
                                            <li><span class="extppt">ppsm</span></li>
                                            <li><span class="extppt">ppsx</span></li>
                                            <li><span class="extppt">pptm</span></li>
                                            <li><span class="extppt">pptx</span></li>
                                            <li><span class="extppt">odp</span></li>
                                            <li><span class="extxls">ods</span></li>
                                            <li><span class="extxls">sxc</span></li>
                                            <li><span class="extxls">xls</span></li>
                                            <li><span class="extxls">xlt</span></li>
                                            <li><span class="extxls">xlsm</span></li>
                                            <li><span class="extxls">xlsx</span></li>
                                            <li><span class="extxls">xltx</span></li>
                                            <li><span class="extxls">csv</span></li>
                                            <li><span class="extxml">xml</span></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li><span class="exthtm">htm</span></li>
                                            <li><span class="exthtm">html</span></li>
                                            <li><span class="exthtm">xhtml</span></li>
                                            <li><span class="extxml">xml</span></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li><span class="extxif">xliff</span></li>
                                            <li><span class="extxif">sdlxliff</span></li>
                                            <li><span class="extttx">ttx</span></li>
                                            <li><span class="extitd">itd</span></li>
                                            <li><span class="extxlf">xlf</span></li>
                                            <li><span class="exttmx">tmx</span></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li><span class="extmif">mif</span></li>
                                            <li><span class="extidd">inx</span></li>
                                            <li><span class="extidd">idml</span></li>
                                            <li><span class="extidd">icml</span></li>
                                            <li><span class="extqxp">xtg</span></li>
                                            <li><span class="exttag">tag</span></li>
                                            <li><span class="extxml">xml</span></li>
                                            <li><span class="extdit">dita</span></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li><span class="extpro">properties</span></li>
                                            <li><span class="extrcc">rc</span></li>
                                            <li><span class="extres">resx</span></li>
                                            <li><span class="extxml">xml</span></li>
                                            <li><span class="extdit">dita</span></li>
                                            <li><span class="extsgl">sgml</span></li>
                                            <li><span class="extsgm">sgm</span></li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody></table>
                        
                      
                          <a class="gototop" href="#top">Go to top</a>        
			</div>
           
            <div class="block">
                    <a name="languages"><h3 class="method-title">Supported languages</h3></a>
                      
                        
                            <table class="tablestats" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <th>
                                        Language ( Code )
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                        <ul class="lang-list">
                                            <li>Afrikaans (af-ZA)</li>
                                            <li>Albanian (sq-AL)</li>
                                            <li>Arabic (ar-SA)</li>
                                            <li>Armenian (hy-AM)</li>
                                            <li>Basque (eu-ES)</li>
                                            <li>Bengali (bn-IN)</li>
                                            <li>Bielarus (be-BY)</li>
                                            <li>Bosnian (bs-BA)</li>
                                            <li>Breton (br-FR)</li>
                                            <li>Bulgarian (bg-BG)</li>
                                            <li>Catalan (ca-ES)</li>
                                            <li>Chinese Simplified (zh-CN)</li>
                                            <li>Chinese Traditional (zh-TW)</li>
                                            <li>Croatian (hr-HR)</li>
                                            <li>Czech (cs-CZ)</li>
                                            <li>Danish (da-DK)</li>
                                            <li>Dutch (nl-NL)</li>
                                            <li>English (en-GB)</li>
                                            <li>English US (en-US)</li>
                                            <li>Estonian (et-EE)</li>
                                            <li>Faroese (fo-FO)</li>
                                            <li>Finnish (fi-FI)</li>
                                            <li>Flemish (nl-BE)</li>
                                            <li>French (fr-FR)</li>
                                            <li>Galician (gl-ES)</li>
                                            <li>Georgian (ka-GE)</li>
                                            <li>German (de-DE)</li>
                                            <li>Greek (el-GR)</li>
                                            <li>Gujarati (gu-IN)</li>
                                            <li>Hebrew (he-IL)</li>
                                            <li>Hindi (hi-IN)</li>
                                            <li>Hungarian (hu-HU)</li>
                                            <li>Icelandic (is-IS)</li>
                                            <li>Indonesian (id-ID)</li>
                                            <li>Irish Gaelic (ga-IE)</li>
                                            <li>Italian (it-IT)</li>
                                            <li>Japanese (ja-JP)</li>
                                            <li>Kazakh (kk-KZ)</li>
                                            <li>Korean (ko-KR)</li>
                                            <li>Latvian (lv-LV)</li>
                                            <li>Lithuanian (lt-LT)</li>
                                            <li>Macedonian (mk-MK)</li>
                                            <li>Malay (ms-MY)</li>
                                            <li>Maltese (mt-MT)</li>
                                            <li>Maori (mi-NZ)</li>
                                            <li>Mongolian (mn-MN)</li>
                                            <li>Nepali (ne-NP)</li>
                                            <li>Norwegian Bokmål (nb-NO)</li>
                                            <li>Norwegian Nynorsk (nn-NO)</li>
                                            <li>Pakistani (ur-PK)</li>
                                            <li>Pashto (ps-PK)</li>
                                            <li>Persian (fa-IR)</li>
                                            <li>Polish (pl-PL)</li>
                                            <li>Portuguese (pt-PT)</li>
                                            <li>Portuguese Brazil (pt-BR)</li>
                                            <li>Quebecois (fr-CA)</li>
                                            <li>Quechua (qu-XN)</li>
                                            <li>Romanian (ro-RO)</li>
                                            <li>Russian (ru-RU)</li>
                                            <li>Serbian Latin (sr-Latn-RS)</li>
                                            <li>Serbian Cyrillic (sr-Cyrl-RS)</li>
                                            <li>Slovak (sk-SK)</li>
                                            <li>Slovenian (sl-SI)</li>
                                            <li>Spanish (es-ES)</li>
                                            <li>Spanish Latin America (es-MX)</li>
                                            <li>Swedish (sv-SE)</li>
                                            <li>Swiss German (de-CH)</li>
                                            <li>Tamil (ta-LK)</li>
                                            <li>Telugu (te-IN)</li>
                                            <li>Thai (th-TH)</li>
                                            <li>Turkish (tr-TR)</li>
                                            <li>Ukrainian (uk-UA)</li>
                                            <li>Vietnamese (vi-VN)</li>
                                            <li>Welsh (cy-GB)</li>
                                        </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        
                        
                        
                        <a class="last gototop" href="#top">Go to top</a>
             </div>
              <div class="block">
            </div>
	</div>
</div>
<script type="text/javascript">
jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 30) {
        jQuery(".colsx").addClass("menuscroll");
    }
	else {
		 jQuery(".colsx").removeClass("menuscroll");
	}
	
});

 var position = [];
    
    jQuery('.block').each(function(){
        position.push(Math.abs(jQuery(this).position().top))
    })

console.log(position)

    jQuery(window).scroll( function() {
        
        var value = jQuery(this).scrollTop() + jQuery('.menu').height();
        
        jQuery.each(position, function(i){
            if(this > value){
                jQuery('.selected').removeClass('selected');
                jQuery(".menu li").eq(i-1).addClass('selected');
                return false;
            }
        })
    });
jQuery( ".menu a " ).click(function() {
  jQuery(this).addClass('selected');
});
jQuery(function() {
  jQuery('a[href*=#]:not([href=#])').click(function() {
if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = jQuery(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>
</body>
</html>
