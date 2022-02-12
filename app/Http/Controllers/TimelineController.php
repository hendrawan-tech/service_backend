<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Timeline;
use Illuminate\Http\Request;
use App\Http\Requests\TimelineStoreRequest;
use App\Http\Requests\TimelineUpdateRequest;

class TimelineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Timeline::class);

        $search = $request->get('search', '');

        $timelines = Timeline::search($search)
            ->latest()
            ->paginate(5);

        return view('app.timelines.index', compact('timelines', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Timeline::class);

        $services = Service::pluck('id', 'id');

        return view('app.timelines.create', compact('services'));
    }

    /**
     * @param \App\Http\Requests\TimelineStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimelineStoreRequest $request)
    {
        $this->authorize('create', Timeline::class);

        $validated = $request->validated();

        $timeline = Timeline::create($validated);

        return redirect()
            ->route('timelines.edit', $timeline)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Timeline $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Timeline $timeline)
    {
        $this->authorize('view', $timeline);

        return view('app.timelines.show', compact('timeline'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Timeline $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Timeline $timeline)
    {
        $this->authorize('update', $timeline);

        $services = Service::pluck('id', 'id');

        return view('app.timelines.edit', compact('timeline', 'services'));
    }

    /**
     * @param \App\Http\Requests\TimelineUpdateRequest $request
     * @param \App\Models\Timeline $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(TimelineUpdateRequest $request, Timeline $timeline)
    {
        $this->authorize('update', $timeline);

        $validated = $request->validated();

        $timeline->update($validated);

        return redirect()
            ->route('timelines.edit', $timeline)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Timeline $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Timeline $timeline)
    {
        $this->authorize('delete', $timeline);

        $timeline->delete();

        return redirect()
            ->route('timelines.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
