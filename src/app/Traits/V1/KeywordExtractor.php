<?php

namespace App\Traits\V1;

trait KeywordExtractor
{
    /**
     * @param string $text
     * @param string $returnType
     * @param array|null $stopWords
     * @param int $limit
     * @return string|array
     */
    public function extractKeywords(string $text, string $returnType = 'array', ?array $stopWords = null, int $limit = 10): string|array
    {
        // Define default stop words
        $defaultStopWords = [
            'a',
            'an',
            'the',
            'and',
            'is',
            'in',
            'to',
            'of',
            'on',
            'for',
            'with',
            'at',
            'by',
            'from',
            'this',
            'that',
            'it',
            'you',
            'as',
            'are',
            'was',
            'were',
            'be',
            'or',
            'but',
            'not',
            'your',
        ];

        // Use provided stop words or fallback to default
        $stopWords = $stopWords ?? $defaultStopWords;

        // Convert text to lowercase
        $text = strtolower($text);

        // Remove punctuation and special characters
        $text = preg_replace('/[^\w\s]/', '', $text);

        // Split the text into words
        $words = str_word_count($text, 1);

        // Filter out stop words
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return !in_array($word, $stopWords);
        });

        // Count word frequencies
        $wordFrequencies = array_count_values($filteredWords);

        // Sort words by frequency in descending order
        arsort($wordFrequencies);

        // Return the top keywords
        $keywords = array_keys(array_slice($wordFrequencies, 0, $limit, true));

        if ($returnType === 'string') {
            $keywords = implode(',', $keywords);
        }

        return $keywords;
    }
}
