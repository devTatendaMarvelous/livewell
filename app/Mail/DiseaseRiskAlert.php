<?php

    namespace App\Mail;

    use App\Models\DiseaseRisk;
    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class DiseaseRiskAlert extends Mailable
    {
        use Queueable, SerializesModels;

        public $diseaseRisk;
        public $farmer;

        public function __construct(DiseaseRisk $diseaseRisk, User $farmer)
        {
            $this->diseaseRisk = $diseaseRisk;
            $this->farmer = $farmer;
        }

        public function envelope()
        {
            return new Envelope(
                subject: 'Disease Risk Alert: ' . $this->diseaseRisk->disease_name,
            );
        }

        public function content()
        {
            return new Content(
                view: 'emails.disease-risk-alert',
            );
        }

        public function attachments()
        {
            return [];
        }
    }
