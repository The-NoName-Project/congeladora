<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use Exception;

class PdfReaderController extends ApiController
{
    public function getDataPdf(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'pdf' => 'required|mimes:pdf|max:2048'
            ]);

            if ($request->file('pdf')) {
                $pdf = 'pdf/' . date('Y-m-d') . '_' . $request->file('pdf')->getClientOriginalName();
                $pdf = $request->file('pdf')->storeAs('public', $pdf);
                $pdf = str_replace("public/", "", $pdf);
            } else {
                return $this->handleError(
                    msg: 'You must upload a pdf file'
                );
            }


            $pdf_route = storage_path('app/public/' . $pdf);

            $data_extracted['text'] = Pdf::getText($pdf_route);
            $data_extracted['pdf'] = $pdf;
            $data_extracted['name'] = $request->file('pdf')->getClientOriginalName();
            $data_extracted['size'] = $request->file('pdf')->getSize();

            Storage::delete('public/' . $pdf);

            return $this->handleResponse(
                data: $data_extracted,
                msg: 'Your text has been extracted successfully'
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->handleError($e);
        }
    }
}
