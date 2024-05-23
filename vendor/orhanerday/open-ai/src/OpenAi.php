<?php

namespace Orhanerday\OpenAi;

use Exception;

class OpenAi
{
    private string $engine = "davinci";
    private string $model = "text-davinci-002";
    private string $chatModel = "gpt-3.5-turbo";
    private array $headers;
    private array $contentTypes;
    private int $timeout = 0;
    private $stream_method;
    private string $customUrl = "";
    private string $proxy = "";
    private array $curlInfo = [];

    public function __construct($OPENAI_API_KEY)
    {
        $this->contentTypes = [
            "application/json" => "Content-Type: application/json",
            "multipart/form-data" => "Content-Type: multipart/form-data",
        ];

        $this->headers = [
            $this->contentTypes["application/json"],
            "Authorization: Bearer $OPENAI_API_KEY",
        ];
    }

    public function getCURLInfo(): array
    {
        return $this->curlInfo;
    }

    public function listModels(): bool|string
    {
        $url = Url::fineTuneModel();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function retrieveModel($model): bool|string
    {
        $model = "/$model";
        $url = Url::fineTuneModel() . $model;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function complete($opts): bool|string
    {
        $engine = $opts['engine'] ?? $this->engine;
        $url = Url::completionURL($engine);
        unset($opts['engine']);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function completion($opts, $stream = null): bool|string
    {
        if (array_key_exists('stream', $opts) && $opts['stream']) {
            if ($stream == null) {
                throw new Exception(
                    'Please provide a stream function. Check https://github.com/orhanerday/open-ai#stream-example for an example.'
                );
            }

            $this->stream_method = $stream;
        }

        $opts['model'] = $opts['model'] ?? $this->model;
        $url = Url::completionsURL();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function createEdit($opts): bool|string
    {
        $url = Url::editsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function image($opts): bool|string
    {
        $url = Url::imageUrl() . "/generations";
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function imageEdit($opts): bool|string
    {
        $url = Url::imageUrl() . "/edits";
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function createImageVariation($opts): bool|string
    {
        $url = Url::imageUrl() . "/variations";
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function search($opts): bool|string
    {
        $engine = $opts['engine'] ?? $this->engine;
        $url = Url::searchURL($engine);
        unset($opts['engine']);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function answer($opts): bool|string
    {
        $url = Url::answersUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function classification($opts): bool|string
    {
        $url = Url::classificationsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function moderation($opts): bool|string
    {
        $url = Url::moderationUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function chat($opts, $stream = null): bool|string
    {
        if ($stream != null && array_key_exists('stream', $opts)) {
            if (!$opts['stream']) {
                throw new Exception(
                    'Please provide a stream function. Check https://github.com/orhanerday/open-ai#stream-example for an example.'
                );
            }

            $this->stream_method = $stream;
        }

        $opts['model'] = $opts['model'] ?? $this->chatModel;
        $url = Url::chatUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function transcribe($opts): bool|string
    {
        $url = Url::transcriptionsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function translate($opts): bool|string
    {
        $url = Url::translationsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function uploadFile($opts): bool|string
    {
        $url = Url::filesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function listFiles(): bool|string
    {
        $url = Url::filesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function retrieveFile($file_id): bool|string
    {
        $file_id = "/$file_id";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function retrieveFileContent($file_id): bool|string
    {
        $file_id = "/$file_id/content";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function deleteFile($file_id): bool|string
    {
        $file_id = "/$file_id";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    public function createFineTune($opts): bool|string
    {
        $url = Url::fineTuneUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function listFineTunes(): bool|string
    {
        $url = Url::fineTuneUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function retrieveFineTune($fine_tune_id): bool|string
    {
        $fine_tune_id = "/$fine_tune_id";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function cancelFineTune($fine_tune_id): bool|string
    {
        $fine_tune_id = "/$fine_tune_id/cancel";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST');
    }

    public function listFineTuneEvents($fine_tune_id): bool|string
    {
        $fine_tune_id = "/$fine_tune_id/events";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function deleteFineTune($fine_tune_id): bool|string
    {
        $fine_tune_id = "/$fine_tune_id";
        $url = Url::fineTuneModel() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    public function engines(): bool|string
    {
        $url = Url::enginesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function engine($engine): bool|string
    {
        $url = Url::engineUrl($engine);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function embeddings($opts): bool|string
    {
        $url = Url::embeddings();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function createRun($threadId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function retrieveRun($threadId, $runId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function listRuns($threadId, $query = []): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs';
        if (count($query) > 0) {
            $url .= '?' . http_build_query($query);
        }
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function deleteRun($threadId, $runId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    public function createRunStep($threadId, $runId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId . '/steps';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function retrieveRunStep($threadId, $runId, $stepId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId . '/steps/' . $stepId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function listRunSteps($threadId, $runId, $query = []): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId . '/steps';
        if (count($query) > 0) {
            $url .= '?' . http_build_query($query);
        }
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function modifyRunStep($threadId, $runId, $stepId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId . '/steps/' . $stepId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function deleteRunStep($threadId, $runId, $stepId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/runs/' . $runId . '/steps/' . $stepId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    public function createTask($threadId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function retrieveTask($threadId, $taskId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function listTasks($threadId, $query = []): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks';
        if (count($query) > 0) {
            $url .= '?' . http_build_query($query);
        }
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function modifyTask($threadId, $taskId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function deleteTask($threadId, $taskId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    public function createTaskComment($threadId, $taskId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId . '/comments';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function retrieveTaskComment($threadId, $taskId, $commentId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId . '/comments/' . $commentId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function listTaskComments($threadId, $taskId, $query = []): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId . '/comments';
        if (count($query) > 0) {
            $url .= '?' . http_build_query($query);
        }
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    public function modifyTaskComment($threadId, $taskId, $commentId, $data): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId . '/comments/' . $commentId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $data);
    }

    public function deleteTaskComment($threadId, $taskId, $commentId): bool|string
    {
        $this->headers[] = 'OpenAI-Beta: assistants=v1';
        $url = Url::threadsUrl() . '/' . $threadId . '/tasks/' . $taskId . '/comments/' . $commentId;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    private function baseUrl($url): string
    {
        if ($this->customUrl != "") {
            $url = $this->customUrl . $url;
        }

        if ($this->proxy != "") {
            $url = str_replace("https://api.openai.com", $this->proxy, $url);
        }

        return $url;
    }

    private function sendRequest($url, $method, $data = null): bool|string
    {
        $ch = curl_init();

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        } elseif ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        $this->curlInfo = curl_getinfo($ch);
        curl_close($ch);

        return $response;
    }
}

class Url
{
    public static function completionURL($engine): string
    {
        return "https://api.openai.com/v1/engines/$engine/completions";
    }

    public static function completionsURL(): string
    {
        return "https://api.openai.com/v1/completions";
    }

    public static function editsUrl(): string
    {
        return "https://api.openai.com/v1/edits";
    }

    public static function imageUrl(): string
    {
        return "https://api.openai.com/v1/images";
    }

    public static function searchURL($engine): string
    {
        return "https://api.openai.com/v1/engines/$engine/search";
    }

    public static function answersUrl(): string
    {
        return "https://api.openai.com/v1/answers";
    }

    public static function classificationsUrl(): string
    {
        return "https://api.openai.com/v1/classifications";
    }

    public static function moderationUrl(): string
    {
        return "https://api.openai.com/v1/moderations";
    }

    public static function chatUrl(): string
    {
        return "https://api.openai.com/v1/chat/completions";
    }

    public static function transcriptionsUrl(): string
    {
        return "https://api.openai.com/v1/audio/transcriptions";
    }

    public static function translationsUrl(): string
    {
        return "https://api.openai.com/v1/audio/translations";
    }

    public static function filesUrl(): string
    {
        return "https://api.openai.com/v1/files";
    }

    public static function fineTuneUrl(): string
    {
        return "https://api.openai.com/v1/fine-tunes";
    }

    public static function fineTuneModel(): string
    {
        return "https://api.openai.com/v1/models";
    }

    public static function enginesUrl(): string
    {
        return "https://api.openai.com/v1/engines";
    }

    public static function engineUrl($engine): string
    {
        return "https://api.openai.com/v1/engines/$engine";
    }

    public static function embeddings(): string
    {
        return "https://api.openai.com/v1/embeddings";
    }

    public static function threadsUrl(): string
    {
        return "https://api.openai.com/v1/assistants/threads";
    }
}

