<?php

namespace JeffersonGoncalves\FilamentErp\Core\Concerns;

use DomainException;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Core\Contracts\SubmittableDocument;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;

/**
 * Provides the Submit / Cancel record actions that drive the
 * domain document lifecycle ({@see SubmittableDocument::submit()} /
 * {@see SubmittableDocument::cancel()}). Any {@see DomainException} thrown by
 * the domain (e.g. an unbalanced journal entry) is surfaced as a Filament
 * danger notification instead of bubbling up as an error.
 *
 * Documents that need extra input at submit time (e.g. a ledger-posting
 * document collecting a counter GL account) override {@see submitActionSchema()}
 * to add fields to the submit modal and {@see beforeSubmit()} to apply the
 * collected data to the record before it is submitted. Both hooks are no-ops by
 * default, so a plain confirmation modal is used when neither is overridden.
 */
trait SubmittableRecordActions
{
    /** @return array<int, Action> */
    public static function submittableRecordActions(): array
    {
        $submit = Action::make('submit')
            ->label('Submit')
            ->icon(Heroicon::OutlinedCheckCircle)
            ->color('success')
            ->visible(fn (Model $record): bool => $record->getAttribute('docstatus') === DocStatus::Draft)
            ->action(function (Model $record, array $data): void {
                if (! $record instanceof SubmittableDocument) {
                    return;
                }

                static::beforeSubmit($record, $data);

                try {
                    $record->submit();

                    Notification::make()
                        ->title('Document submitted')
                        ->success()
                        ->send();
                } catch (DomainException $exception) {
                    Notification::make()
                        ->title('Unable to submit document')
                        ->body($exception->getMessage())
                        ->danger()
                        ->send();
                }
            });

        $schema = static::submitActionSchema();

        if ($schema === []) {
            $submit->requiresConfirmation();
        } else {
            $submit->schema($schema);
        }

        return [
            $submit,
            Action::make('cancel')
                ->label('Cancel')
                ->icon(Heroicon::OutlinedXCircle)
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (Model $record): bool => $record->getAttribute('docstatus') === DocStatus::Submitted)
                ->action(function (Model $record): void {
                    if (! $record instanceof SubmittableDocument) {
                        return;
                    }

                    try {
                        $record->cancel();

                        Notification::make()
                            ->title('Document cancelled')
                            ->success()
                            ->send();
                    } catch (DomainException $exception) {
                        Notification::make()
                            ->title('Unable to cancel document')
                            ->body($exception->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    /**
     * The schema collected in the submit modal. Empty by default (a plain
     * confirmation); documents needing extra submit-time input override this.
     *
     * @return array<int, mixed>
     */
    protected static function submitActionSchema(): array
    {
        return [];
    }

    /**
     * Apply submit-modal data to the record before it is submitted. No-op by
     * default; documents needing extra submit-time input override this.
     *
     * @param  array<string, mixed>  $data
     */
    protected static function beforeSubmit(Model $record, array $data): void
    {
        //
    }
}
