<?php

class Report {
    private $reportId;
    private $userId;
    private $message;
    private $reportType;
    private $generatedAt;
    private $subject;

    // Constructeur
    public function __construct($reportData) {
        $this->reportId = $reportData['report_id'] ?? null;
        $this->userId = $reportData['user_id'] ?? null;
        $this->message = $reportData['message'] ?? null;
        $this->reportType = $reportData['report_type'] ?? null;
        $this->generatedAt = $reportData['generated_at'] ?? null;
        $this->subject = $reportData['subject'] ?? null;
    }

    // Getters
    public function getReportId() {
        return $this->reportId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getReportType() {
        return $this->reportType;
    }

    public function getGeneratedAt() {
        return $this->generatedAt;
    }

    public function getSubject() {
        return $this->subject;
    }

    // Setters
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setReportType($reportType) {
        $this->reportType = $reportType;
    }

    public function setGeneratedAt($generatedAt) {
        $this->generatedAt = $generatedAt;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }
}
