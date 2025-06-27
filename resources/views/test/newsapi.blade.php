<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsAPI Test - BuzzWire</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background: #f5f5f5; 
            line-height: 1.6;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .warning { color: #ffc107; font-weight: bold; }
        .test-section { 
            margin: 20px 0; 
            padding: 15px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            background: #fafafa;
        }
        .article-card { 
            border: 1px solid #ccc; 
            padding: 15px; 
            margin: 10px 0; 
            border-radius: 5px; 
            background: #fff; 
        }
        .env-check { 
            display: flex; 
            justify-content: space-between; 
            padding: 8px; 
            border-bottom: 1px solid #eee; 
        }
        .back-btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-btn:hover {
            background: #0056b3;
            color: white;
            text-decoration: none;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-error { background: #f8d7da; color: #721c24; }
        .badge-warning { background: #fff3cd; color: #856404; }
        h1 { color: #333; border-bottom: 3px solid #007bff; padding-bottom: 10px; }
        h2 { color: #555; margin-top: 25px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 NewsAPI Integration Test</h1>
        <p>Testing NewsAPI connection and functionality for BuzzWire News platform...</p>

        <!-- Environment Check -->
        <div class="test-section">
            <h2>🔧 Environment Check</h2>
            <div class="env-check">
                <span>API Key:</span>
                <span class="{{ $results['environment']['api_key'] !== 'Not Set' ? 'success' : 'error' }}">
                    {{ $results['environment']['api_key'] }}
                </span>
            </div>
            <div class="env-check">
                <span>Base URL:</span>
                <span class="{{ $results['environment']['base_url'] !== 'Not Set' ? 'success' : 'error' }}">
                    {{ $results['environment']['base_url'] }}
                </span>
            </div>
            <div class="env-check">
                <span>GuzzleHttp:</span>
                <span class="{{ $results['environment']['guzzle'] === 'Available' ? 'success' : 'error' }}">
                    {{ $results['environment']['guzzle'] }}
                </span>
            </div>
            <div class="env-check">
                <span>cURL:</span>
                <span class="{{ $results['environment']['curl'] === 'Available' ? 'success' : 'error' }}">
                    {{ $results['environment']['curl'] }}
                </span>
            </div>
            <div class="env-check">
                <span>DNS/Internet:</span>
                <span class="{{ $results['environment']['dns'] === 'Available' ? 'success' : 'error' }}">
                    {{ $results['environment']['dns'] }}
                </span>
            </div>
        </div>

        <!-- Headlines Test -->
        <div class="test-section">
            <h2>📰 Top Headlines Test</h2>
            @if($results['headlines']['success'])
                <p class="success">✅ Headlines Test: SUCCESS</p>
                <p><strong>Message:</strong> {{ $results['headlines']['message'] }}</p>
                <p><strong>Total Results:</strong> {{ number_format($results['headlines']['total_results']) }}</p>
                <p><strong>Articles Retrieved:</strong> {{ $results['headlines']['articles_count'] }}</p>
                
                @if(count($results['headlines']['articles']) > 0)
                    <h3>Sample Articles:</h3>
                    @foreach($results['headlines']['articles'] as $index => $article)
                        <div class="article-card">
                            <h4>{{ $index + 1 }}. {{ $article['title'] ?? 'No Title' }}</h4>
                            <p><strong>Source:</strong> {{ $article['source']['name'] ?? 'Unknown' }}</p>
                            <p><strong>Description:</strong> {{ Str::limit($article['description'] ?? 'No description', 200) }}</p>
                            <p><strong>Published:</strong> {{ $article['publishedAt'] ?? 'Unknown' }}</p>
                            @if(!empty($article['urlToImage']))
                                <p><strong>Image:</strong> <a href="{{ $article['urlToImage'] }}" target="_blank">View Image</a></p>
                            @endif
                        </div>
                    @endforeach
                @endif
            @else
                <p class="error">❌ Headlines Test: FAILED</p>
                <p><strong>Error:</strong> {{ $results['headlines']['message'] }}</p>
            @endif
        </div>

        <!-- Search Test -->
        <div class="test-section">
            <h2>🔍 Search Function Test</h2>
            @if($results['search']['success'])
                <p class="success">✅ Search Test: SUCCESS</p>
                <p><strong>Message:</strong> {{ $results['search']['message'] }}</p>
                <p><strong>Search Results:</strong> {{ $results['search']['articles_count'] }}</p>
                
                @if(count($results['search']['articles']) > 0)
                    <h3>Sample Search Results:</h3>
                    @foreach($results['search']['articles'] as $index => $article)
                        <div class="article-card">
                            <h4>{{ $index + 1 }}. {{ $article['title'] ?? 'No Title' }}</h4>
                            <p><strong>Source:</strong> {{ $article['source']['name'] ?? 'Unknown' }}</p>
                        </div>
                    @endforeach
                @endif
            @else
                <p class="error">❌ Search Test: FAILED</p>
                <p><strong>Error:</strong> {{ $results['search']['message'] }}</p>
            @endif
        </div>

        <!-- Category Test -->
        <div class="test-section">
            <h2>📂 Category Filter Test</h2>
            @if($results['category']['success'])
                <p class="success">✅ Category Test: SUCCESS</p>
                <p><strong>Message:</strong> {{ $results['category']['message'] }}</p>
                <p><strong>Category Results:</strong> {{ $results['category']['articles_count'] }}</p>
                
                @if(count($results['category']['articles']) > 0)
                    <h3>Sample Category Articles (Teknologi):</h3>
                    @foreach($results['category']['articles'] as $index => $article)
                        <div class="article-card">
                            <h4>{{ $index + 1 }}. {{ $article['title'] ?? 'No Title' }}</h4>
                            <p><strong>Source:</strong> {{ $article['source']['name'] ?? 'Unknown' }}</p>
                        </div>
                    @endforeach
                @endif
            @else
                <p class="error">❌ Category Test: FAILED</p>
                <p><strong>Error:</strong> {{ $results['category']['message'] }}</p>
            @endif
        </div>

        <!-- Diagnosis -->
        <div class="test-section">
            <h2>🚀 Diagnosis & Recommendations</h2>
            @php
                $allPassed = $results['headlines']['success'] && $results['search']['success'] && $results['category']['success'];
                $apiConnected = $results['headlines']['success'] || $results['search']['success'];
            @endphp

            @if($allPassed)
                <div class="status-badge badge-success">ALL TESTS PASSED ✅</div>
                <p><strong>Great!</strong> Your NewsAPI integration is working perfectly. The articles should now appear on your homepage.</p>
                <ul>
                    <li>✅ API connection is stable</li>
                    <li>✅ Headlines are being retrieved</li>
                    <li>✅ Search function is working</li>
                    <li>✅ Category filtering is functional</li>
                </ul>
                <p><strong>If articles still don't appear on homepage:</strong></p>
                <ul>
                    <li>Clear cache: <code>php artisan cache:clear</code></li>
                    <li>Check ArticleController home() method</li>
                    <li>Verify welcome.blade.php template</li>
                </ul>
            @elseif($apiConnected)
                <div class="status-badge badge-warning">PARTIAL SUCCESS ⚠️</div>
                <p><strong>API is connected</strong> but some functions failed. This might be due to:</p>
                <ul>
                    <li>Limited results for Indonesia (common on free plan)</li>
                    <li>Rate limiting</li>
                    <li>Specific query restrictions</li>
                </ul>
            @else
                <div class="status-badge badge-error">CONNECTION FAILED ❌</div>
                <p><strong>API connection failed.</strong> Possible issues:</p>
                <ul>
                    <li><strong>Invalid API Key:</strong> Check your NewsAPI account</li>
                    <li><strong>Rate Limit:</strong> You may have exceeded free tier limits</li>
                    <li><strong>Network Issue:</strong> Server cannot reach newsapi.org</li>
                    <li><strong>Config Issue:</strong> Check config/newsapi.php file</li>
                </ul>
                <p><strong>Solutions:</strong></p>
                <ul>
                    <li>Verify API key at <a href="https://newsapi.org/account" target="_blank">NewsAPI.org</a></li>
                    <li>Check your plan limits and usage</li>
                    <li>Ensure config/newsapi.php exists and is properly set</li>
                </ul>
            @endif
        </div>

        <!-- Config File Check -->
        <div class="test-section">
            <h2>📋 Config File Status</h2>
            @if(config('newsapi.api_key'))
                <p class="success">✅ Config file is loaded and API key is set</p>
            @else
                <p class="error">❌ Config file missing or API key not set</p>
                <p><strong>Create config/newsapi.php with:</strong></p>
                <pre style="background: #f4f4f4; padding: 10px; border-radius: 4px;">
&lt;?php
return [
    'api_key' => env('NEWSAPI_KEY', 'cd2cac24f5984ed595185134362e76b3'),
    'base_url' => env('NEWSAPI_URL', 'https://newsapi.org/v2'),
];
                </pre>
            @endif
        </div>

        <div style="text-align: center;">
            <a href="{{ route('home') }}" class="back-btn">← Back to Homepage</a>
            <a href="{{ route('test.newsapi') }}" class="back-btn" style="background: #28a745;">🔄 Refresh Test</a>
        </div>
    </div>
</body>
</html>