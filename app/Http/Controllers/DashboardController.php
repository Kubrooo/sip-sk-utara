<?php

namespace App\Http\Controllers;

use App\Enums\SubmissionStatus;
use App\Models\SkSubmission;
use App\Models\SkTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display dashboard overview with status metrics.
     */
    public function index(): View
    {
        $user = Auth::user();
        $query = SkSubmission::query();

        if ($user->hasRole('admin_kelurahan')) {
            $query->where('kelurahan_id', $user->id);
        }

        $stats = [
            'draft' => (clone $query)->where('status', SubmissionStatus::DRAFT_KELURAHAN)->count(),
            'review_kecamatan' => (clone $query)->where('status', SubmissionStatus::REVIEW_KECAMATAN)->count(),
            'review_hukum' => (clone $query)->where('status', SubmissionStatus::REVIEW_HUKUM)->count(),
            'ready_approval' => (clone $query)->where('status', SubmissionStatus::READY_FOR_APPROVAL)->count(),
            'approved' => (clone $query)->where('status', SubmissionStatus::APPROVED)->count(),
            'total' => (clone $query)->count(),
        ];

        $recentSubmissions = (clone $query)->with(['template', 'kelurahan'])->latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'recentSubmissions'));
    }
}
