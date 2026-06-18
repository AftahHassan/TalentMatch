@extends('layouts.app')

@php $title = 'Support & Documentation' @endphp

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Support & Documentation</h1>
        <p class="mt-1.5 text-sm text-gray-500">Learn how to use TalentMatch effectively</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <div class="lg:col-span-3 card p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Getting Started</h2>
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Step 1: Create a Job Offer</h3>
                        <p class="mt-1 text-sm text-gray-500">Start by creating a new job offer from your dashboard. Fill in the position title, description, required skills, and preferred qualifications. You can also set custom scoring weights for different criteria.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Step 2: Submit a Candidate CV</h3>
                        <p class="mt-1 text-sm text-gray-500">Upload a candidate's CV in PDF format and link it to the relevant job offer. The system will automatically extract and structure the candidate's information for analysis.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Step 3: Review the Analysis</h3>
                        <p class="mt-1 text-sm text-gray-500">Once the CV is processed, view the AI-generated analysis including a match score, skills assessment, experience evaluation, and detailed recommendations for each candidate.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Step 4: Chat with the AI Assistant</h3>
                        <p class="mt-1 text-sm text-gray-500">Use the AI Chat to ask questions about candidates, compare qualifications, or get recommendations. The assistant remembers your conversation context for a seamless experience.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Step 5: Compare Candidates</h3>
                        <p class="mt-1 text-sm text-gray-500">View all analyzed candidates side by side with their scores and key metrics. Make informed hiring decisions based on AI-powered insights and data-driven comparisons.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 card p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">FAQ</h2>
            <div x-data="{ open: null }" class="space-y-2">
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = open === 0 ? null : 0" class="cursor-pointer flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-900">How long does the AI analysis take?</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open === 0 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-show="open === 0" class="px-4 pb-3">
                        <p class="text-sm text-gray-500">Most analyses complete within 30–60 seconds. Complex CVs with extensive experience may take slightly longer. You'll be notified once the analysis is ready.</p>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = open === 1 ? null : 1" class="cursor-pointer flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-900">What AI model is used?</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-show="open === 1" class="px-4 pb-3">
                        <p class="text-sm text-gray-500">TalentMatch uses OpenAI's GPT-4 model for CV analysis and the AI Chat assistant. This ensures high-quality, accurate evaluations of candidate profiles against job requirements.</p>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = open === 2 ? null : 2" class="cursor-pointer flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-900">Can I re-analyze a CV?</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-show="open === 2" class="px-4 pb-3">
                        <p class="text-sm text-gray-500">Yes, you can re-analyze a CV at any time. This is useful if the job requirements have changed or if you want to apply new scoring criteria. Simply navigate to the analysis and click &quot;Re-analyze&quot;.</p>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = open === 3 ? null : 3" class="cursor-pointer flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-900">What does the score mean?</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-show="open === 3" class="px-4 pb-3">
                        <p class="text-sm text-gray-500">Scores range from 0 to 100:</p>
                        <ul class="mt-2 space-y-1 text-sm text-gray-500">
                            <li><span class="inline-block w-16 px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700">0–39</span> Reject — Low match with job requirements</li>
                            <li><span class="inline-block w-16 px-2 py-0.5 rounded text-xs font-medium bg-amber-50 text-amber-700">40–69</span> Pending — Partial match, review manually</li>
                            <li><span class="inline-block w-16 px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-700">70–100</span> Invite — Strong match, suitable for interview</li>
                        </ul>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = open === 4 ? null : 4" class="cursor-pointer flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-900">How does the AI Chat remember context?</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-show="open === 4" class="px-4 pb-3">
                        <p class="text-sm text-gray-500">The AI Chat maintains a conversation history within each session. It remembers your previous questions and the context of your discussion, allowing for natural follow-up questions without repeating information.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
