class NoodleIntermediateController < ApplicationController
  def create
    @noodle = Noodle.find(params[:noodle_id])
    @noodle_sub = NoodleSub.find(params[:noodle_sub_id])
  end
end
